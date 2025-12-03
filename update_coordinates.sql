-- Update koordinat kantor ke lokasi baru
UPDATE settings SET value = '-6.2160896' WHERE `key` = 'office_latitude';
UPDATE settings SET value = '106.8859392' WHERE `key` = 'office_longitude';

-- Tampilkan nilai baru
SELECT * FROM settings WHERE `key` IN ('office_latitude', 'office_longitude');
