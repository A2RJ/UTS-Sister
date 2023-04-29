<?php

namespace App\Http\Controllers\Presence;

use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Models\Presence;
use App\Models\Structure;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class FilePresenceController extends Controller
{
    public function myPresence()
    {
        try {
            $result = Presence::getAllPresences([Auth::id()], false);
            return $this->allPresences($result);
        } catch (Exception $e) {
            return $this->responseError($e);
        }
    }

    public function civitas($sdmId)
    {
        try {
            $result = Presence::getAllPresences([$sdmId], false);
            return $this->allPresences($result);
        } catch (Exception $e) {
            return $this->responseError($e);
        }
    }

    public function unit($structureId)
    {
        try {
            $sdmIds = Structure::getSdmIdAllLevel([$structureId]);
            $filter = request('filter');

            if ($filter === 'per-unit') {
                $structureUnder = array_values(Structure::getAllIdsLevelUnder([$structureId]));
                $result = Presence::perUnit($structureUnder, false);
                return $this->perUnit($result);
            } elseif ($filter === 'per-civitas') {
                $result = Presence::perCivitas($sdmIds, false);
                return $this->perCivitas($result);
            } else {
                $result = Presence::getAllPresences($sdmIds, false);
                return $this->allPresences($result);
            }
        } catch (Exception $e) {
            return $this->responseError($e);
        }
    }

    public function subPresence()
    {
        try {
            $filter = request('filter');
            $oneLevelUnder = request('one-level');
            if ($oneLevelUnder) {
                $sdmIds = Structure::getSdmIdOneLevelUnder();
            } else {
                $sdmIds = Structure::getSdmIdAllLevelUnder();
            }

            if ($filter === 'per-unit') {
                if ($oneLevelUnder) {
                    $structureId = Structure::getIdsOneLevelUnder();
                } else {
                    $structureId = Structure::getAllIdsLevelUnder();
                }
                $result = Presence::perUnit($structureId, false);
                return $this->perUnit($result);
            } elseif ($filter === 'per-civitas') {
                $result = Presence::perCivitas($sdmIds, false);
                return $this->perCivitas($result);
            } else {
                $result = Presence::getAllPresences($sdmIds, false);
                return $this->allPresences($result);
            }
        } catch (Exception $e) {
            return $this->responseError($e);
        }
    }

    public function dsdmPresence()
    {
        try {
            $filter = request('filter');
            if ($filter === 'per-unit') {
                $result = Presence::perUnit(false, false);
                return $this->perUnit($result);
            } elseif ($filter === 'per-civitas') {
                $result = Presence::perCivitas(false, false);
                return $this->perCivitas($result);
            } else {
                $result = Presence::getAllPresences(false, false);
                return $this->allPresences($result);
            }
        } catch (Exception $e) {
            return $this->responseError($e);
        }
    }

    public function perUnit($data)
    {
        try {
            return (new FastExcel($data))->download('Absensi.xlsx', function ($item) {
                return [
                    'Jabatan' => $item->role
                ];
            });
        } catch (Exception $e) {
            return $this->responseError($e);
        }
    }

    public function perCivitas($data)
    {
        try {
            return (new FastExcel($data))->download('Absensi.xlsx', function ($item) {
                return [
                    'Nama' => $item->sdm_name,
                    'NIDN' => $item->nidn,
                    'Jabatan' => $item->roles(),
                    'Jam Efektif' => $item->effective_hours
                ];
            });
        } catch (Exception $e) {
            return $this->responseError($e);
        }
    }

    public function allPresences($data)
    {
        try {
            return (new FastExcel($data))->download('Absensi.xlsx', function ($item) {
                return [
                    'Nama' => $item->sdm_name,
                    'NIDN' => $item->nidn,
                    'Jabatan' => $item->roles(),
                    'Tanggal' => DateHelper::format_tgl_id($item->check_in_date),
                    'Jam Masuk' => $item->check_in_hour,
                    'Jam Pulang' => $item->check_out_hour,
                    'Jam Efektif' => $item->effective_hours
                ];
            });
        } catch (Exception $e) {
            return $this->responseError($e);
        }
    }
}
