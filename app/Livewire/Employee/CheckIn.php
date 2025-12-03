<?php

namespace App\Livewire\Employee;

use App\Helpers\DistanceHelper;
use App\Models\Attendance;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CheckIn extends Component
{
    use WithFileUploads;

    // Properties
    public $photo;
    public $latitude;
    public $longitude;
    public $type = 'check_in'; // 'check_in' atau 'check_out'
    public $isLoading = false;

    // Validation rules
    protected $rules = [
        'photo' => 'required|image|max:5120', // Max 5MB
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'type' => 'required|in:check_in,check_out',
    ];

    protected $messages = [
        'photo.required' => 'Foto selfie wajib diambil.',
        'photo.image' => 'File harus berupa gambar.',
        'photo.max' => 'Ukuran foto maksimal 5MB.',
        'latitude.required' => 'Lokasi GPS tidak terdeteksi. Aktifkan GPS Anda.',
        'longitude.required' => 'Lokasi GPS tidak terdeteksi. Aktifkan GPS Anda.',
        'type.required' => 'Tipe absensi tidak valid.',
    ];

    /**
     * Check status absensi hari ini
     */
    public function mount()
    {
        $user = auth()->user();

        // Auto-detect type berdasarkan history hari ini
        if (!$user->hasCheckedInToday()) {
            $this->type = 'check_in';
        } elseif (!$user->hasCheckedOutToday()) {
            $this->type = 'check_out';
        } else {
            $this->type = 'check_in'; // Default (meskipun sudah check-in dan check-out)
        }
    }

    /**
     * Submit attendance (check-in atau check-out)
     */
    public function submit()
    {
        $this->isLoading = true;

        try {
            // Validasi input
            $this->validate();

            $user = auth()->user();

            // Validasi: Tidak bisa check-in 2x dalam sehari
            if ($this->type === 'check_in' && $user->hasCheckedInToday()) {
                session()->flash('error', 'Anda sudah melakukan check-in hari ini!');
                $this->isLoading = false;
                return;
            }

            // Validasi: Tidak bisa check-out tanpa check-in dulu
            if ($this->type === 'check_out' && !$user->hasCheckedInToday()) {
                session()->flash('error', 'Anda belum melakukan check-in hari ini!');
                $this->isLoading = false;
                return;
            }

            // Validasi: Tidak bisa check-out 2x dalam sehari
            if ($this->type === 'check_out' && $user->hasCheckedOutToday()) {
                session()->flash('error', 'Anda sudah melakukan check-out hari ini!');
                $this->isLoading = false;
                return;
            }

            // Get office coordinates dari settings
            $officeLat = Setting::getOfficeLatitude();
            $officeLon = Setting::getOfficeLongitude();
            $allowedRadius = Setting::getAttendanceRadius();

            // Hitung jarak menggunakan Haversine Formula
            $distance = DistanceHelper::calculate(
                $officeLat,
                $officeLon,
                $this->latitude,
                $this->longitude
            );

            // Validasi radius
            if ($distance > $allowedRadius) {
                session()->flash(
                    'error',
                    "Anda terlalu jauh dari kantor! Jarak Anda: " . DistanceHelper::format($distance) .
                    ". Maksimal: " . DistanceHelper::format($allowedRadius) . "."
                );
                $this->isLoading = false;
                return;
            }

            // Upload photo
            $photoPath = $this->photo->store('attendance-photos', 'public');

            // Tentukan status (on_time atau late)
            $status = $this->determineStatus();

            // Create attendance record
            Attendance::create([
                'user_id' => $user->id,
                'type' => $this->type,
                'photo' => $photoPath,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'distance' => $distance,
                'status' => $status,
            ]);

            // Success message
            $message = $this->type === 'check_in'
                ? "✅ Check-in berhasil! Jarak: " . DistanceHelper::format($distance)
                : "✅ Check-out berhasil! Jarak: " . DistanceHelper::format($distance);

            session()->flash('success', $message);

            // Reset form
            $this->reset(['photo', 'latitude', 'longitude']);
            $this->isLoading = false;

            // Refresh page untuk update status
            return redirect()->route('employee.check-in');

        } catch (\Exception $e) {
            \Log::error('Attendance Error: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan. Silakan coba lagi.');
            $this->isLoading = false;
        }
    }

    /**
     * Tentukan status attendance (on_time atau late)
     */
    private function determineStatus(): string
    {
        $now = now();
        $workStartTime = Setting::getWorkStartTime(); // Format: "08:00"
        $lateTolerance = (int) Setting::get('late_tolerance_minutes', 15);

        if ($this->type === 'check_in') {
            // Parse work start time
            $startTime = \Carbon\Carbon::createFromFormat('H:i', $workStartTime);
            $lateThreshold = $startTime->copy()->addMinutes($lateTolerance);

            // Check apakah terlambat
            if ($now->greaterThan($lateThreshold)) {
                return 'late';
            }

            return 'on_time';
        }

        // Untuk check-out, default on_time (bisa diperluas untuk early_leave logic)
        return 'on_time';
    }

    /**
     * Render component
     */
    public function render()
    {
        $user = auth()->user();
        $todayCheckIn = $user->getTodayCheckIn();
        $todayCheckOut = $user->getTodayCheckOut();

        return view('livewire.employee.check-in', [
            'todayCheckIn' => $todayCheckIn,
            'todayCheckOut' => $todayCheckOut,
        ])->layout('layouts.mobile');
    }
}
