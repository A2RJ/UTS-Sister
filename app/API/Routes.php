<?php

namespace App\API;

use Illuminate\Support\Facades\Http;

/**
 * Routes
 */
trait Routes
{    
    /**
     * index
     *
     * @return void
     */
    private static function index()
    {
       if (!session('token')) {
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
        if ($response['detail'] == "Token expired") {
            session()->forget('token');
            self::index();
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
        self::index();
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
        self::index();
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
        self::index();
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
        self::index();
        return Http::withToken(session(('token')))->delete(env('SISTER_SERVER') . $url)->throw(function ($response, $e) {
            self::trowError($response, $e);
        })->json();
    }
}
