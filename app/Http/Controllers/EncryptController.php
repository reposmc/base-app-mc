<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Crypt;

class EncryptController extends Controller
{
    public static function encryptArray($array, array $keys)
    {
        foreach ($array as $model) {
            foreach ($keys as $value) {
                $model[$value] = Crypt::encrypt($model[$value]);
            }
        }

        return $array;
    }

    public static function decryptArray($array, array $keys)
    {
        foreach ($array as $model) {
            foreach ($keys as $value) {
                $model[$value] = Crypt::decrypt($model[$value]);
            }
        }

        return $array;
    }

    public static function encryptModel($model, $key)
    {
        $model[$key] = Crypt::encrypt($model[$key]);

        return $model;
    }

    public static function decryptModel($model, $key)
    {
        $model[$key] = Crypt::decrypt($model[$key]);

        return $model;
    }

    public static function encryptValue($value)
    {
        $value = Crypt::encrypt($value);

        return $value;
    }

    public static function decryptValue($value)
    {
        $value = Crypt::decrypt($value);

        return $value;
    }
}
