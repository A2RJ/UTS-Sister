<?php

namespace App\API;

use Illuminate\Support\Facades\Http;

/**
 * Routes
 */
trait Routes
{    
    /**
     * token
     *
     * @return void
     */
    private static function token()
    {
       if (session('token') == null) {
          $token = Http::post(env('SISTER_SERVER') . '/authorize', [
             'username' => env('SISTER_USERNAME'),
             'password' => env('SISTER_PASSWORD'),
             'id_pengguna' => env('SISTER_ID')
          ]);
          session(['token' => $token['token']]);
       }
    }
    
    /**
     * trowError
     *
     * @param  mixed $response
     * @param  mixed $e
     * @return void
     */
    private static function trowError($response, $e)
    {
        if ($response['detail'] == "Token expired" || $response['detail'] == "Token tidak ditemukan") {
            session()->forget('token');
            self::token();
        }
    }
    
    /**
     * get
     *
     * @param  mixed $url
     * @param  mixed $array
     * @return void
     */
    public static function get($url, $array = null)
    {
        self::token();
        if ($array) {
            return Http::withToken(session(('token')))->get(env('SISTER_SERVER') . $url, $array)->throw(function ($response, $e) {
                self::trowError($response, $e);
            })->json();
        }

        return Http::withToken(session(('token')))->get(env('SISTER_SERVER') . $url)->throw(function ($response, $e) {
            self::trowError($response, $e);
        })->json();
    }
    
    /**
     * post
     *
     * @param  mixed $url
     * @param  mixed $array
     * @return void
     */
    public static function post($url, $array)
    {
        self::token();
        return Http::withToken(session(('token')))->post(env('SISTER_SERVER') . $url, $array)->throw(function ($response, $e) {
            self::trowError($response, $e);
        })->json();
    }
    
    /**
     * put
     *
     * @param  mixed $url
     * @param  mixed $array
     * @return void
     */
    public static function put($url, $array)
    {
        self::token();
        return Http::withToken(session(('token')))->put(env('SISTER_SERVER') . $url, $array)->throw(function ($response, $e) {
            self::trowError($response, $e);
        })->json();
    }
    
    /**
     * deleteID
     *
     * @param  mixed $url
     * @return void
     */
    public static function deleteID($url)
    {
        self::token();
        return Http::withToken(session(('token')))->delete(env('SISTER_SERVER') . $url)->throw(function ($response, $e) {
            self::trowError($response, $e);
        })->json();
    }
}
