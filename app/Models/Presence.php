<?php

namespace App\Models;

use App\Helpers\FileHelper;
use App\Traits\Model\UtilsFunction;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * App\Models\Presence
 *
 * @property int $id
 * @property int|null $sdm_id
 * @property string $latitude_in
 * @property string $longitude_in
 * @property string|null $check_in_time
 * @property string|null $check_out_time
 * @property string|null $latitude_out
 * @property string|null $longitude_out
 * @property int $permission
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\PresenceAttachment|null $attachment
 * @property-read \App\Models\HumanResource|null $humanResource
 * @property-read \App\Models\HumanResource|null $sdm
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read int|null $structure_count
 * @method static \Illuminate\Database\Eloquent\Builder|Presence export(?array $columns = null)
 * @method static \Database\Factories\PresenceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Presence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Presence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Presence query()
 * @method static \Illuminate\Database\Eloquent\Builder|Presence search(?string $keyword, array $columns = [], array $relations = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Presence searchManual(?string $keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|Presence whereCheckInTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presence whereCheckOutTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presence whereLatitudeIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presence whereLatitudeOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presence whereLongitudeIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presence whereLongitudeOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presence wherePermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presence whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presence workHours()
 * @mixin \Eloquent
 */
class Presence extends Model
{
    use HasFactory, UtilsFunction;

    protected $fillable = [
        'sdm_id',
        'check_in_time',
        'latitude_in',
        'longitude_in',
        'check_out_time',
        'latitude_out',
        'longitude_out',
        'permission',
        'created_at'
    ];
    static $latitude = 80;
    static $longitude = 80;
    static $jenisIzin = [
        'Izin Cuti',
        'Izin Sakit',
        'Izin Berkegiatan Diluar 1/2 Hari',
        'Izin Berkegiatan Diluar 1 Hari Atau Lebih',
        'Terkendala Absen Masuk',
        'Terkendala Absen Pulang',
    ];
    static $workingTime = [
        'Dosen' => 18,
        'Dosen DT' => 30,
        'Tenaga Kependidikan' => 35,
        'Security' => 55,
        'Customer Service' => 55,
    ];

    public static function workHour($sdmType)
    {
        $workHour = [
            'Dosen' => [
                'in' => "07:00",
                'out' => "19:00",
            ],
            'Dosen DT' => [
                'in' => "07:00",
                'out' => "19:00",
            ],
            'Tenaga Kependidikan' => [
                'in' => "09:00",
                'out' => "16:00",
            ],
            'Security 1' => [
                'in' => "17:00",
                'out' => "06:00",
            ],
            'Security 2' => [
                'in' => "06:00",
                'out' => "17:00",
            ],
            'Customer Service' => [
                'in' => "07:00",
                'out' => "17:00",
            ],
        ];
        if (!array_key_exists(Str::title($sdmType), $workHour))  throw new Exception('Invalid sdm_type' . $sdmType);
        return $workHour[Str::title($sdmType)];
    }

    public static function isLate($sdmType)
    {
        return Carbon::now()->format('H:i') > Presence::workHour($sdmType)['in'];
    }

    public static function isTendik($sdmType)
    {
        return $sdmType == 'Tenaga Kependidikan';
    }

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function humanResource()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id', 'id');
    }

    public function sdm()
    {
        return $this->belongsTo(HumanResource::class, 'sdm_id');
    }

    public function attachment()
    {
        return $this->hasOne(PresenceAttachment::class, 'presence_id');
    }

    public function structure()
    {
        return $this->hasManyThrough(
            Structure::class,
            StructuralPosition::class,
            'sdm_id', // Foreign key on struktural table...
            'id', // Foreign key on structure table...
            'sdm_id', // Local key on presence table...
            'structure_id' // Local key on struktural table...
        );
    }

    public function roles()
    {
        return $this->structure
            ->pluck('role')
            ->reject(function ($role) {
                return $role === 'admin';
            })
            ->implode(', <br>');
    }

    public function detail()
    {
        $words = explode(' ', $this->attachment->detail);
        $lineCount = count($words) / 5;
        $result = '';

        for ($i = 0; $i < $lineCount; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $index = $i * 5 + $j;
                if (isset($words[$index])) {
                    $result .= $words[$index] . ' ';
                }
            }
            $result .= "<br>";
        }

        return $result;
    }

    public static function subPresence()
    {
        $filter = request('filter');
        $oneLevelUnder = request('one-level', false);
        if ($oneLevelUnder) $sdmIds = Structure::getSdmIdOneLevelUnder();
        else $sdmIds = Structure::getSdmIdAllLevelUnder();

        if ($filter === 'per-unit') {
            if ($oneLevelUnder) $structureId = Structure::getIdsOneLevelUnder();
            else $structureId = Structure::getAllIdsLevelUnder();
            return Presence::perUnit($structureId);
        } elseif ($filter === 'per-civitas') {
            return Presence::perCivitas($sdmIds);
        } else {
            return Presence::getAllPresences($sdmIds);
        }
    }

    public static function dsdmPresence()
    {
        $filter = request('filter');

        if ($filter === 'per-unit') {
            return Presence::perUnit();
        } elseif ($filter === 'per-civitas') {
            return Presence::perCivitas();
        } else {
            return Presence::getAllPresences();
        }
    }

    public static function perUnit($structureId = false, $paginate = true)
    {
        $search = request('search');
        $result = Structure::whereNot('role', 'admin')
            ->when($structureId, function ($query) use ($structureId) {
                return $query->whereIn('id', $structureId);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('role', 'LIKE', "%$search%");
            });

        if (!$paginate) return $result->get();
        return $result->paginate()
            ->appends(request()->except('page'));
    }

    public static function perCivitas($sdmIds = false, $paginate = true)
    {
        $end = request('end');
        $start = request('start');
        $search = request('search');
        $isSearchROle = Str::contains($search, ':');
        $role = $isSearchROle ? str_replace(':', '', $search) : '';

        $result = HumanResource::join('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->select(
                'human_resources.sdm_name',
                'human_resources.id',
                'human_resources.nidn',
                'human_resources.sdm_type',
            )
            ->workHours()
            ->when($sdmIds, function ($query) use ($sdmIds) {
                return $query->whereIn('human_resources.id', $sdmIds);
            })
            ->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('presences.created_at', [$start, $end]);
            })
            ->when($search && !$isSearchROle, function ($query) use ($search) {
                return $query->where('human_resources.sdm_name', 'like', "%$search%");
            })
            ->when($isSearchROle, function ($query) use ($role) {
                return $query->where('human_resources.sdm_type', 'like', "%$role%");
            })
            ->groupBy(
                'human_resources.id',
                'human_resources.sdm_name',
                'human_resources.nidn',
                'human_resources.sdm_type',
            );

        if (!$paginate) return $result->get();
        return $result->paginate()
            ->appends(request()->except('page'));
    }

    public static function getAllPresences($sdmIds = false, $paginate = true)
    {
        $search = request('search');
        $start = request('start');
        $end = request('end');

        $isSearchROle = Str::contains($search, ':');
        $role = $isSearchROle ? str_replace(':', '', $search) : '';

        $result = HumanResource::join('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->select(
                'human_resources.id',
                'human_resources.sdm_name',
                'human_resources.nidn',
                'human_resources.sdm_type',
                DB::raw("DATE_FORMAT(check_in_time, '%W, %d-%m-%Y') AS check_in_date"),
                DB::raw("DATE_FORMAT(check_out_time, '%W, %d-%m-%Y') AS check_out_date"),
                DB::raw("DATE_FORMAT(check_in_time, '%H:%i') AS check_in_hour"),
                DB::raw("DATE_FORMAT(check_out_time, '%H:%i') AS check_out_hour")
            )
            ->workHours()
            ->when($sdmIds, function ($query) use ($sdmIds) {
                return $query->whereIn('human_resources.id', $sdmIds);
            })
            // ->when($start && $end, function ($query) use ($start, $end) {
            //     return $query->whereBetween('presences.created_at', [$start, $end]);
            // })
            ->when($start && $end, function ($query) use ($start, $end) {
                $end = date('Y-m-d', strtotime($end . ' +1 day'));
                return $query->where(function ($query) use ($start, $end) {
                    $query->whereDate('presences.check_in_time', $start)
                        ->orWhereDate('presences.check_out_time', $start)
                        ->orWhereBetween('presences.check_in_time', [$start, $end])
                        ->orWhereBetween('presences.check_out_time', [$start, $end]);
                });
            })
            ->when($search && !$isSearchROle, function ($query) use ($search) {
                return $query->where('human_resources.sdm_name', 'like', "%$search%");
            })
            ->when($isSearchROle, function ($query) use ($role) {
                return $query->where('human_resources.sdm_type', 'like', "%$role%");
            })
            ->groupBy(
                'human_resources.id',
                'human_resources.sdm_name',
                'human_resources.nidn',
                'human_resources.sdm_type',
                'presences.check_in_time',
                'presences.check_out_time'
            );

        if (!$paginate) return $result->get();
        return $result->paginate()
            ->appends(request()->except('page'));
    }

    public static function totalPresenceHour($isSdmOrAdmin = false)
    {
        $sdmIds = [];
        if (!$isSdmOrAdmin) {
            $oneLevelUnder = request('one-level');
            if ($oneLevelUnder) $sdmIds = Structure::getSdmIdOneLevelUnder();
            else $sdmIds = Structure::getSdmIdAllLevelUnder();
        }

        $start = request('start');
        $end = request('end');

        return HumanResource::join('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->when(!$isSdmOrAdmin, function ($query) use ($sdmIds) {
                return $query->whereIn('human_resources.id', $sdmIds);
            })
            ->workHours()
            ->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('presences.created_at', [$start, $end]);
            })
            ->first();
    }

    /**
     * Permission
     */
    public static function myPermission()
    {
        $result = Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
            ->where('presences.sdm_id', Auth::id())
            ->where('permission', 0)
            ->with('attachment')
            ->select(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'presences.created_at'
            )
            ->groupBy(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'presences.created_at'
            )
            ->paginate()
            ->appends(request()->except('page'));

        return $result;
    }

    public static function subPermission()
    {
        $sdmId = Structure::getSdmIdOneLevelUnder();
        $result = Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
            ->whereIn('presences.sdm_id', $sdmId)
            ->where('permission', 0)
            ->with(['attachment', 'humanResource'])
            ->select(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'presences.created_at'
            )
            ->groupBy(
                'presences.id',
                'presences.sdm_id',
                'sdm_name',
                'presences.created_at'
            )
            ->paginate()
            ->appends(request()->except('page'));

        return $result;
    }

    // API
    public static function myPresenceAPI($sdm_id)
    {
        $start = request('start');
        $end = request('end');

        if (!$start) $start = Carbon::now()->startOfWeek();
        if (!$end) $end = Carbon::now()->endOfWeek();

        return Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
            ->select(
                'presences.id',
                'presences.sdm_id',
                DB::raw("DATE_FORMAT(check_in_time, '%W, %d-%m-%Y') AS check_in_date"),
                DB::raw("DATE_FORMAT(check_out_time, '%W, %d-%m-%Y') AS check_out_date"),
                DB::raw("DATE_FORMAT(check_in_time, '%H:%i') AS check_in_hour"),
                DB::raw("DATE_FORMAT(check_out_time, '%H:%i') AS check_out_hour")
            )
            ->workHours()
            ->where('presences.sdm_id', $sdm_id)
            ->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('presences.created_at', [$start, $end]);
            })
            ->groupBy(
                'presences.id',
                'presences.sdm_id',
                'presences.check_in_time',
                'presences.check_out_time'
            )
            ->get();
    }

    public static function getPresenceHours($sdm_id, $isWeb = false)
    {
        $start = request('start', Carbon::now()->startOfWeek());
        $end = request('end', Carbon::now()->endOfWeek());

        $query = HumanResource::join('presences', 'human_resources.id', '=', 'presences.sdm_id')
            ->where('human_resources.id', $sdm_id)
            ->workHours()
            ->when($start && $end, function ($query) use ($start, $end) {
                return $query->whereBetween('presences.created_at', [$start, $end]);
            });

        if ($isWeb) return $query->first();
        return $query->select(
            'human_resources.sdm_name',
            'human_resources.id'
        )
            ->groupBy(
                'human_resources.sdm_name',
                'human_resources.id',
                'human_resources.sdm_type'
            )
            ->first();
    }

    private static function getDetail($presence, $jenisIzin, $izinDetail)
    {
        $detail = "";

        if ($presence->attachment && $presence->attachment->detail) {
            $detail .= $presence->attachment->detail . ", ";
        }

        $detail .= Presence::$jenisIzin[$jenisIzin - 1] . " - " . $izinDetail;
        return $detail;
    }

    public static function permission($request)
    {
        try {
            DB::beginTransaction();

            $jenisIzin = $request->jenis_izin;

            if (in_array($jenisIzin, [1, 2, 3, 4])) {
                $dateRange = self::dateRange($request->user()->sdm_type, $request->start_date, $request->end_date);

                $dates = collect($dateRange)->map(function ($date) {
                    return Carbon::parse($date['in'])->format('Y-m-d');
                })->toArray();
                $presences = Presence::where('sdm_id', $request->user()->id)
                    ->whereIn(DB::raw('DATE(created_at)'), $dates)
                    ->get()
                    ->pluck('created_at')
                    ->map(function ($createdAt) {
                        return Carbon::parse($createdAt)->format('d-m-Y');
                    });

                if ($presences->isNotEmpty()) throw new Exception('Anda telah absensi atau izin pada tanggal: ' . $presences->implode(', '));

                if ($jenisIzin == 1) {
                    $forms = self::generatePermissionArrayFromRange($dateRange, function ($value) use ($request) {
                        return [
                            'sdm_id' => $request->user()->id,
                            'check_in_time' => $value['in'],
                            'check_out_time' => $value['out'],
                            'permission' => 0,
                            'created_at' => $value['in']
                        ];
                    });
                } elseif ($jenisIzin == 2) {
                    $forms = self::generatePermissionArrayFromRange($dateRange, function ($value) use ($request) {
                        return [
                            'sdm_id' => $request->user()->id,
                            'check_in_time' => null,
                            'permission' => 0,
                            'created_at' => $value['in']
                        ];
                    });
                } elseif ($jenisIzin == 3) {
                    $forms = self::generatePermissionArrayFromRange([$dateRange[0]], function ($value) use ($request) {
                        return [
                            'sdm_id' => $request->user()->id,
                            'check_in_time' => $value['in'],
                            'permission' => 0,
                            'created_at' => $value['in']
                        ];
                    });
                } elseif ($jenisIzin == 4) {
                    $forms = self::generatePermissionArrayFromRange($dateRange, function ($value) use ($request) {
                        return [
                            'sdm_id' => $request->user()->id,
                            'check_in_time' => $value['in'],
                            'check_out_time' => $value['out'],
                            'permission' => 0,
                            'created_at' => $value['in']
                        ];
                    });
                }

                $filename = FileHelper::upload($request, 'attachment', 'attachments');

                foreach ($forms as $form) {
                    $presence = Presence::create($form);
                    $presence->attachment()->create([
                        'attachment' => $filename,
                        'detail' => self::getDetail($presence, $jenisIzin, $request->detail)
                    ]);
                }
            } elseif (in_array($jenisIzin, [5, 6])) {
                $presence = Presence::where('sdm_id', $request->user()->id)
                    ->whereDate(DB::raw('DATE(created_at)'), Carbon::today()->format('Y-m-d'))
                    ->latest()
                    ->first();

                if ($jenisIzin == 5) {
                    if ($presence) throw new Exception('Anda sudah absen masuk hari ini', 422);
                    $form = [
                        'sdm_id' => $request->user()->id,
                        'check_in_time' => Carbon::now()->format('Y-m-d H:i:s'),
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'permission' => 0
                    ];

                    $presence = Presence::create($form);
                } elseif ($jenisIzin == 6) {
                    if (!$presence) throw new Exception('Anda belum absen masuk hari ini', 422);
                    if ($presence->check_out_time) throw new Exception('Anda sudah mengisi absen pulang hari ini', 422);

                    $presence->update([
                        'check_out_time' => Carbon::now()->format('Y-m-d H:i:s'),
                        'permission' => 0
                    ]);
                }

                $filename = FileHelper::upload($request, 'attachment', 'attachments');
                $presence->attachment()->updateOrCreate(
                    ['presence_id' => $presence->id],
                    [
                        'attachment' => $filename,
                        'detail' => self::getDetail($presence, $jenisIzin, $request->detail)
                    ]
                );
            }

            DB::commit();
            return true;
        } catch (Exception $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public static function dateRange($sdmType, string $start, string|null $end): array
    {
        try {
            $start = Carbon::parse($start)->startOfDay();

            $in = Presence::workHour($sdmType)['in'];
            $out = Presence::workHour($sdmType)['out'];

            $dateRange = [];
            if ($end != null) {
                $end = Carbon::parse($end)->endOfDay();
                for ($date = $start; $date->lte($end); $date->addDay()) {
                    $dateRange[] = [
                        'in' => Carbon::parse($date->toDateString() . ' ' . $in)->format('Y-m-d H:i:s'),
                        'out' => Carbon::parse($date->toDateString() . ' ' . $out)->format('Y-m-d H:i:s')
                    ];
                }
            } else {
                $dateRange[] = [
                    'in' => Carbon::parse($start->toDateString() . ' ' . $in)->format('Y-m-d H:i:s'),
                    'out' => Carbon::parse($start->toDateString() . ' ' . $out)->format('Y-m-d H:i:s')
                ];
            }

            return $dateRange;
        } catch (Exception $th) {
            throw $th;
        }
    }

    public static function generatePermissionArrayFromRange(array $dateRange, callable $callback): array
    {
        $result = [];
        foreach ($dateRange as $value) {
            $result[] = $callback($value);
        }

        return $result;
    }
}
