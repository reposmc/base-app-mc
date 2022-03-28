<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Crypt;

class EncryptController extends Controller
{
    public static function encryptArray($array, array $keys)
    {
        $data = [];

        foreach ($array as $model) {
            foreach ($keys as $value) {
                $model->{$value} = Crypt::encrypt(strval($model[$value]));
            }
            array_push($data, $model->getAttributes());
        }

        return $data;
    }

    public static function decryptArray($array, array $keys)
    {
        $data = [];

        foreach ($array as $model) {
            foreach ($keys as $value) {
                $model->{$value} = Crypt::decrypt($model[$value]);
            }
            array_push($data, $model->getAttributes());
        }

        return $data;
    }

    public static function encryptModel($model, $key)
    {
        $data = strval($model[$value]);
        $model[$key] = Crypt::encrypt($data);

        return $model;
    }

    public static function decryptModel($model, $key)
    {
        $model[$key] = intval(Crypt::decrypt($model[$key]));

        return $model;
    }

    public static function encryptValue($value)
    {
        $data = strval($value);
        $value = Crypt::encrypt($data);
        return $value;
    }

    public static function decryptValue($value)
    {
        $value = intval(Crypt::decrypt($value));
        return $value;
    }

    public static function encryptArrayValues($array, array $keys)
    {
        foreach ($keys as $value) {
            $array[$value] = Crypt::encrypt($array[$value]);
        }

        return $array;
    }

    public static function decryptArrayValues($array, array $keys)
    {
        foreach ($keys as $value) {
            $array[$value] = Crypt::decrypt($array[$value]);
        }

        return $array;
    }
}

