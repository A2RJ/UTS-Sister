<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Makassar');

        Paginator::useBootstrap();

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
            return (new PendingRequest)->withToken(
                // return PendingRequest::withToken(
                session('token')
            )->baseUrl(env('SISTER_URL') . "/data_pribadi");
        });
        Response::macro('pool', function ($item, $key) {
            $collect = [];
            for ($i = 0; $i < count($item); $i++) {
                $collect = array_merge($collect, [
                    $key[$i] => $item[$i]->json()
                ]);
            }
            return $collect;
        });
        Builder::macro('getDiffAttribute', function () {
            return $this->addSelect(
                DB::raw("GREATEST(0, (CASE 
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL(((18*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL(((30*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL(((CASE 
                        WHEN TIME(check_out_time) > '16:00:00' 
                            THEN (16*60) - TIME_TO_SEC('16:00:00')/60 
                        ELSE 
                            SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))
                        END)) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL(((55*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL(((55*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                ELSE 0
                END)) as testing"),
                DB::raw("GREATEST(0, (CASE 
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL(((18*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL(((30*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL(((35*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL(((55*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL(((55*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) DIV 60, 0)
                ELSE 0
                END)) as hour_difference"),
                DB::raw("GREATEST(0, (CASE 
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL(((18*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL(((30*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL(((35*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL(((55*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL(((55*60) - SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time))) MOD 60, 0)
                ELSE 0
                    END)) as minute_difference"),
                DB::raw(
                    "GREATEST(0, (CASE
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (18*60)) DIV 60),0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (30*60)) DIV 60),0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (35*60)) DIV 60),0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (55*60)) DIV 60),0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (55*60)) DIV 60),0)
                ELSE 0
                END)) as overtime_hours"
                ),
                DB::raw("GREATEST(0, (CASE 
                WHEN human_resources.sdm_type = 'Dosen' 
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (18*60)) MOD 60),0)
                WHEN human_resources.sdm_type = 'Dosen DT' 
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (30*60)) MOD 60),0)
                WHEN human_resources.sdm_type = 'Tenaga Kependidikan' 
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (35*60)) MOD 60),0)
                WHEN human_resources.sdm_type = 'Security'
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (55*60)) MOD 60),0)
                WHEN human_resources.sdm_type = 'Customer Service'
                    THEN IFNULL(((SUM(TIMESTAMPDIFF(MINUTE, check_in_time, check_out_time)) - (55*60)) MOD 60),0)
                ELSE 0
                END)) as overtime_minutes"),
            )
                ->where('permission', 1);
        });
    }
}
