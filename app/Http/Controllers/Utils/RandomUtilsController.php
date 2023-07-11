<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use App\Models\HumanResource;
use App\Models\Presence;
use App\Models\Structure;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;

class RandomUtilsController extends Controller
{
    public function importDosen(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->validate($request, [
                'file' => 'required'
            ]);
            $dosen = $request->file('file');
            $collection = (new FastExcel())->import($dosen);
            $collection = $collection->map(function ($item) {
                $name = Str::lower(trim(explode(',', $item['Nama Dosen'])[0]));
                $sdm = HumanResource::where('sdm_name', 'LIKE', "%$name%")->first();
                if ($sdm && $sdm->count() > 0) {
                    $sdm_id = $sdm->sdm_id;
                    $exist = 1;
                    $nidn = $sdm->nidn;
                    $account = 1;
                } else {
                    $sdm_id = (new Student())->genId(date('DMYhis'));
                    $exist = 0;
                    $nidn = $item['Nomor Registrasi Forlap'] == 'Belum' ? '12345678' : $item['Nomor Registrasi Forlap'];
                    $account = 0;
                }
                return [
                    "account" => $account,
                    "sdm_id" => $sdm_id,
                    "sdm_name" => $item['Nama Dosen'],
                    "email" => $this->extractEmailUsername('/\s+/', '.', $name) . '@uts.ac.id',
                    "nidn" => $nidn,
                    "password" => Hash::make($nidn),
                    "nip" => NULL,
                    "active_status_name" => 'Aktif',
                    "employee_status" => 'Non PNS',
                    "sdm_type" => 'Dosen',
                    "is_sister_exist" => $exist,
                ];
            });
            $data = $collection->filter(function ($item) {
                return $item['account'] === 0;
            })->map(function ($item) {
                return collect($item)->forget('account')->toArray();
            })->values()->toArray();
            $result = HumanResource::insert($data);
            Db::commit();
            return response($result);
        } catch (Exception $th) {
            DB::rollBack();
            return response($th->getMessage());
        }
    }

    public function importTendik(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->validate($request, [
                'file' => 'required'
            ]);
            $dosen = $request->file('file');
            $collection = (new FastExcel())->import($dosen);
            $collection = $collection->map(function ($item) {
                $name = Str::lower(trim(explode(',', $item['Nama'])[0]));
                $sdm = HumanResource::where('sdm_name', 'LIKE', "%$name%")->first();
                if ($sdm && $sdm->count() > 0) {
                    $sdm_id = $sdm->sdm_id;
                    $exist = 1;
                    $nidn = $sdm->nidn;
                    $account = 1;
                } else {
                    $sdm_id = (new Student())->genId(date('DMYhis'));
                    $exist = 0;
                    $nidn = $item['NITK'] == '' ? '12345678' : $item['NITK'];
                    $account = 0;
                }
                return [
                    "account" => $account,
                    "sdm_id" => $sdm_id,
                    "sdm_name" => $item['Nama'],
                    "email" => $this->convertToEmail($name),
                    "nidn" => $nidn,
                    "password" => Hash::make($nidn),
                    "nip" => NULL,
                    "active_status_name" => 'Aktif',
                    "employee_status" => 'Non PNS',
                    "sdm_type" => 'Tenaga Kependidikan',
                    "is_sister_exist" => $exist,
                ];
            });
            $data = $collection->filter(function ($item) {
                return $item['account'] === 0;
            })->map(function ($item) {
                return collect($item)->forget('account')->toArray();
            })->values()->toArray();
            $result = HumanResource::insert($data);
            Db::commit();
            return response($result);
        } catch (Exception $th) {
            DB::rollBack();
            return response($th->getMessage());
        }
    }

    function convertToEmail($name)
    {
        $email = preg_replace('/\s+/', '.', $name);
        $email = preg_replace('/\.{2,}/', '.', $email);
        return $email . '@uts.ac.id';
    }


    public function changeAllEmail(Request $request)
    {
        try {
            DB::beginTransaction();
            $result = HumanResource::whereRaw('email LIKE ?', ['% %'])
                ->update([
                    'email' => DB::raw("CONCAT(REPLACE(REPLACE(email, ' ', '.'), '..', '.'), '@uts.ac.id')"),
                ]);
            DB::commit();
            return response($result);
        } catch (Exception $th) {
            DB::rollBack();
            return response($th->getMessage());
        }
    }

    public function getPerUnitData()
    {
        return response(
            Structure::where('role', '!=', 'admin')
                ->with(['humanResource' => function ($query) {
                    return $query->join('presences', 'human_resources.id', '=', 'presences.sdm_id')
                        ->select(
                            'human_resources.sdm_name',
                            'human_resources.id',
                            'human_resources.sdm_type',

                        )
                        ->workHours()
                        ->groupBy(
                            'human_resources.id',
                            'human_resources.sdm_name',
                            'human_resources.sdm_type',
                            'structural_positions.structure_id'
                        );
                }])->get()
        );
    }

    public function getChild()
    {
        $structure = Structure::getAllStructure(5);
        return response($structure);
    }
}
