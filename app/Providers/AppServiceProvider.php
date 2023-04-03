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
            // return (new PendingRequest)->withToken(
            $http = new PendingRequest();
            return $http->withToken(
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
        Builder::macro('workHours', function () {
            return $this->addSelect(
                DB::raw(
                    'TIME_FORMAT(
                        GREATEST(0, SEC_TO_TIME(SUM(
                            CASE  
                                WHEN sdm_type = "Tenaga Kependidikan" THEN
                                    TIMESTAMPDIFF(
                                        SECOND, 
                                        GREATEST(check_in_time, DATE_ADD(DATE(check_in_time), INTERVAL 9 HOUR)),
                                        LEAST(check_out_time, DATE_ADD(DATE(check_out_time), INTERVAL 16 HOUR))
                                    )
                                WHEN sdm_type = "dosen" THEN
                                    TIMESTAMPDIFF(
                                        SECOND, 
                                        GREATEST(check_in_time, DATE_ADD(DATE(check_in_time), INTERVAL 7 HOUR)),
                                        LEAST(check_out_time, DATE_ADD(DATE(check_out_time), INTERVAL 19 HOUR))
                                    )
                                ELSE 0
                            END
                        ))), "%H:%i:%s"
                    ) as effective_hours'
                ),
                DB::raw('TIME_FORMAT(SUM(0 + 0), "%H:%i:%s") as ineffective_hours')
            )
                ->whereColumn('check_out_time', '>', 'check_in_time')
                // ->where(function ($query) {
                //     $query->whereColumn('check_out_time', '>', 'check_in_time')
                //         ->orWhereNull('check_out_time');
                // })
                ->where('permission', 1);
            // DB::raw(
            //     'TIME_FORMAT(SUM(
            //         CASE
            //             WHEN human_resources.sdm_type = "Dosen" OR human_resources.sdm_type = "Dosen DT" THEN
            //                 IF(TIME(presences.check_out_time) > TIME(presences.check_in_time),
            //                 TIMEDIFF(
            //                     IF(TIME(presences.check_out_time) > TIME("19:00:00"), TIME("19:00:00"), TIME(presences.check_out_time)), 
            //                     IF(TIME(presences.check_in_time) < TIME("07:00:00"), TIME("07:00:00"), TIME(presences.check_in_time))
            //                 ), 0)
            //             WHEN human_resources.sdm_type = "Tenaga Kependidikan" THEN
            //                 IF(TIME(presences.check_out_time) > TIME(presences.check_in_time),
            //                 TIMEDIFF(
            //                     IF(TIME(presences.check_out_time) > TIME("16:00:00"), TIME("16:00:00"), TIME(presences.check_out_time)),
            //                     IF(TIME(presences.check_in_time) < TIME("09:00:00"), TIME("09:00:00"), TIME(presences.check_in_time))
            //                 ), 0) 
            //             ELSE
            //                 0
            //         END
            //     ), "%H:%i:%s") 
            //     as effective_hours'
            // ),
        });
    }

    public function test()
    {
    }
}
