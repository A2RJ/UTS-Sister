<?php

namespace App\Http\Controllers\Presence;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use App\Models\Structure;
use Exception;
use Illuminate\Support\Facades\Auth;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class FilePresenceController extends Controller
{
    public function myPresence()
    {
        try {
            $result = Presence::getAllPresences([Auth::id()], false);
            return $this->allPresences($result);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function civitas($sdmId)
    {
        try {
            $result = Presence::getAllPresences([$sdmId], false);
            return $this->allPresences($result);
        } catch (Exception $th) {
            throw $th;
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
        } catch (Exception $th) {
            throw $th;
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
        } catch (Exception $th) {
            throw $th;
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
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function perUnit($data)
    {
        $header_style = (new Style())
            ->setFontBold()
            ->setShouldWrapText();

        $rows_style = (new Style())
            ->setShouldWrapText();

        try {
            return (new FastExcel($data))
                ->headerStyle($header_style)
                ->rowsStyle($rows_style)
                ->download('Absensi.xlsx', function ($item) {
                    return [
                        'Jabatan' => $item->role
                    ];
                });
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function perCivitas($data)
    {
        $header_style = (new Style())
            ->setFontBold()
            ->setShouldWrapText();

        $rows_style = (new Style())
            ->setShouldWrapText();

        try {
            $end = request('end');
            $start = request('start');
            return (new FastExcel($data))
                ->headerStyle($header_style)
                ->rowsStyle($rows_style)
                ->download('Absensi.xlsx', function ($item) use ($start, $end) {
                    $detail = $item->compareWorkHours($start, $end, $item->sdm_type, $item);
                    return [
                        'Nama' => $item->sdm_name,
                        'NIDN' => $item->nidn,
                        'Status Kepegawaian' => $item->sdm_type,
                        'Jumlah minimal jam' => $detail['targetWorkHours'],
                        'Jumlah jam efektif' => $item->effective_hours,
                        'Jumlah kurang jam' => $detail['less'],
                        'Jumlah lebih jam' => $detail['over']
                    ];
                });
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function allPresences($data)
    {
        $header_style = (new Style())
            ->setFontBold()
            ->setShouldWrapText();

        $rows_style = (new Style())
            ->setShouldWrapText();

        try {
            $end = request('end');
            $start = request('start');
            return (new FastExcel($data))
                ->headerStyle($header_style)
                ->rowsStyle($rows_style)
                ->download('Absensi.xlsx', function ($item) use ($start, $end) {
                    $detail = $item->compareWorkHours($start, $end, $item->sdm_type, $item);
                    return [
                        'Nama' => $item->sdm_name,
                        'NIDN' => $item->nidn,
                        'Status Kepegawaian' => $item->sdm_type,
                        'Tanggal' => $item->checkInDateFormat(),
                        'Jam Masuk' => $item->check_in_hour,
                        'Jam Pulang' => $item->check_out_hour,
                        'Jumlah minimal jam' => $detail['targetWorkHours'],
                        'Jumlah jam efektif' => $item->effective_hours,
                        'Jumlah kurang jam' => $detail['less'],
                        'Jumlah lebih jam' => $detail['over']
                    ];
                });
        } catch (Exception $th) {
            throw $th;
        }
    }
}
