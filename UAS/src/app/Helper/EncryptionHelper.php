<?php

namespace App\Helper;

use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;

class EncryptionHelper
{
    public static function encrypt($data)
    {
        // Gunakan APP_KEY atau KEY_ENCRYPT dari .env
        $key = env('KEY_ENCRYPT', 'defaultkey'); // Diambil dari .env (opsional)
        return Crypt::encryptString($data, false); // Enkripsi string
    }

    public static function decrypt($encryptedData)
    {
        try {
            return Crypt::decryptString($encryptedData); // Dekripsi string
        } catch (\Exception $e) {
            return 'Decryption Failed: ' . $e->getMessage(); // Tangani jika gagal
        }
    }
}