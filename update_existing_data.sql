-- Update existing pendaftars data to set default status_berkas if NULL
UPDATE `pendaftars` 
SET `status_berkas` = 'SUBMIT' 
WHERE `status_berkas` IS NULL OR `status_berkas` = '';

-- Check current data
SELECT id, no_pendaftaran, status, status_berkas, alasan_tolak_berkas 
FROM `pendaftars` 
LIMIT 10;
