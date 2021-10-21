<?php

namespace Illuminate\Database\Eloquent;

use Illuminate\Support\Facades\Http;

class Sister extends Model
{

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

   private static function trowError($response, $e)
   {
      if ($response['detail'] == "Token expired") {
         session()->forget('token');
         self::index();
      }
   }

   public static function get($params)
   {
      self::index();
      return Http::withToken(session(('token')))->get(env('SISTER_SERVER') . $params)->throw(function ($response, $e) {
         self::trowError($response, $e);
      })->json();
   }

   public static function getAgama()
   {
      return self::get('/referensi/agama');
   }
}
