<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Artisan;

class SuperAdminController extends Controller
{
    public function migrate()
    {
        try {
            Artisan::call('migrate:fresh', [
                '--force' => true
            ]);
            return response()->json([
                'result' => "Berhasil migrate:fresh --seed"
            ]);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function rollback()
    {
        try {
            Artisan::call('migrate:rollback', [
                '--force' => true
            ]);
            return response()->json([
                'result' => "Berhasil migrate:rollback"
            ]);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function seed()
    {
        try {
            Artisan::call('db:seed', [
                '--force' => true
            ]);
            return response()->json([
                'result' => "Berhasil db:seed"
            ]);
        } catch (Exception $th) {
            throw $th;
        }
    }
}
