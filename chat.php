Saya mempunyai fungsi untuk menghitung jam kerja dan sudah berhasil, tetapi saya ingin menambahkan keterangan jam kerja terpenuhi, tidak terpenuhi dan melebihi jam kerja
- effective_hours adalah jam kerja total berdasarkan range tanggal start dan date contoh hasilnya 12:34:00
- effective_hours berdasarkan 3 type, hitung kurang jam kerja dan lebih jam kerja berdasarkan:
- jika Dosen maka jam kerja adalah 18 jam perminggu
- jika Dosen DT maka jam kerja adalah 30 jam perminggu
- jika Tenaga kependidikan maka jam kerja adalah 35 jam perminggu
- bagaimana agar ketika range tanggal adalah per minggu maka keterangan jam kerja dihasilkan dihasilkan

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
'presences.check_in_time',
'presences.check_out_time'
);

if (!$paginate) return $result->get();
return $result->paginate()
->appends(request()->except('page'));
}

public function scopeWorkHours($query)
{
return $query->addSelect(
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
WHEN sdm_type = "Dosen" THEN
TIMESTAMPDIFF(
SECOND,
GREATEST(check_in_time, DATE_ADD(DATE(check_in_time), INTERVAL 7 HOUR)),
LEAST(check_out_time, DATE_ADD(DATE(check_out_time), INTERVAL 19 HOUR))
)
WHEN sdm_type = "Dosen DT" THEN
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
->where('permission', 1);
}