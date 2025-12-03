<?php

use App\Models\Setting;

// Update coordinates
Setting::where('key', 'office_latitude')->update(['value' => '-6.2160896']);
Setting::where('key', 'office_longitude')->update(['value' => '106.8859392']);

echo "Office coordinates updated successfully!\n";
echo "New latitude: " . Setting::get('office_latitude') . "\n";
echo "New longitude: " . Setting::get('office_longitude') . "\n";
