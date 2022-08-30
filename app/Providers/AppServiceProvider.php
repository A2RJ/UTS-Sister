<?php

namespace App\Providers;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Http::macro('sister', function () {
            return Http::baseUrl(env('SISTER_URL'));
        });
        Http::macro('referensi', function () {
            return Http::withToken(
                session('token')
            )->baseUrl(env('SISTER_URL') . "/referensi");
        });
        Http::macro('dataPribadi', function () {
            return Http::withToken(
                session('token')
            )->baseUrl(env('SISTER_URL') . "/data_pribadi");
        });
        PendingRequest::macro('dataPribadi', function () {
            return PendingRequest::withToken(
                session('token')
            )->baseUrl(env('SISTER_URL') . "/data_pribadi");
        });
        Response::macro('pool', function ($item) {
            $collect = [];
            for ($i = 0; $i < count($item); $i++) {
                if ($item[$i]->ok()) {
                    $collect = collect($collect)->merge($item[$i]->json());
                } else {
                    // $collect = collect($collect)->merge(["error" => [
                    //     "request_ke" => $i + 1,
                    //     "detail" => $item[$i]->json()
                    // ]]);
                    return response()->json(array_merge($item[$i]->json(), ["request_ke" => $i + 1]), 500);
                }
            }
            return $collect;
        });
    }
}
