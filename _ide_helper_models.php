<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Bkd
 *
 * @property int $id
 * @property string $human_resource_id
 * @property string $period
 * @property string $status
 * @property string $jafung
 * @property string $ab
 * @property string $c
 * @property string $d
 * @property string $e
 * @property string $total
 * @property string $summary
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HumanResource|null $sdm
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereAb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereD($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereHumanResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereJafung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bkd whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Bkd extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Classes
 *
 * @property int $id
 * @property int|null $structure_id
 * @property string $class
 * @property-read \App\Models\Structure|null $structure
 * @method static \Illuminate\Database\Eloquent\Builder|Classes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classes query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereStructureId($value)
 * @mixin \Eloquent
 */
	class Classes extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string $meeting_id
 * @property string $nama
 * @property string $nim
 * @property string|null $komentar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereKomentar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereMeetingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereNim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Coordinate
 *
 * @property int $id
 * @property string $latitude
 * @property string $longitude
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Coordinate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Faculty
 *
 * @property int $id
 * @property string $faculty
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereFaculty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereId($value)
 * @mixin \Eloquent
 */
	class Faculty extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\HumanResource
 *
 * @property int $id
 * @property string|null $sdm_id
 * @property string|null $sdm_name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $nidn
 * @property string|null $nip
 * @property string|null $active_status_name
 * @property string|null $employee_status
 * @property string|null $sdm_type
 * @property int|null $is_sister_exist
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int|null $program_studi_id
 * @property int|null $sdm_type_id
 * @property string|null $mac_address
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read int|null $presence_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read int|null $structure_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource export(?array $columns = null)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource query()
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource search(?string $keyword, array $columns = [], array $relations = [])
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource searchManual(?string $keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereActiveStatusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereEmployeeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereIsSisterExist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereMacAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereNidn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereProgramStudiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereSdmName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereSdmType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereSdmTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HumanResource workHours()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bkd> $bkd
 * @property-read int|null $bkd_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Jafung> $jafung
 * @property-read int|null $jafung_count
 * @mixin \Eloquent
 */
	class HumanResource extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Jafung
 *
 * @property $id
 * @property $human_resource_id
 * @property $jafung
 * @property $sk_number
 * @property $start_from
 * @property $attachment
 * @property $created_at
 * @property $updated_at
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read \App\Models\HumanResource|null $sdm
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung query()
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereHumanResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereJafung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereSkNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereStartFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jafung whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Jafung extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Link
 *
 * @property int $id
 * @property int|null $meeting_id
 * @property string $link
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\Meeting|null $meeting
 * @method static \Illuminate\Database\Eloquent\Builder|Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link query()
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereMeetingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Link extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Meeting
 *
 * @property int $id
 * @property int|null $subject_id
 * @property string $meeting_name
 * @property string|null $date
 * @property string|null $meeting_start
 * @property string|null $file
 * @property-read \App\Models\Subject|null $subject
 * @property-read \App\Models\Link|null $url
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereMeetingName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereMeetingStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereSubjectId($value)
 * @mixin \Eloquent
 */
	class Meeting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Participant
 *
 * @property int $id
 * @property int|null $human_resource_id
 * @property int|null $research_proposal_id
 * @property string $role
 * @property string|null $attachment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereHumanResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereResearchProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\HumanResource|null $humanResource
 */
	class Participant extends \Eloquent {}
}

namespace App\Models{
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
	class Presence extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PresenceAttachment
 *
 * @property int $id
 * @property int|null $presence_id
 * @property string $detail
 * @property string|null $attachment
 * @method static \Database\Factories\PresenceAttachmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PresenceAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PresenceAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PresenceAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|PresenceAttachment whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PresenceAttachment whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PresenceAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PresenceAttachment wherePresenceId($value)
 * @mixin \Eloquent
 */
	class PresenceAttachment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ResearchAssignment
 *
 * @property-read \App\Models\HumanResource $user
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment search()
 * @property int $id
 * @property int|null $sdm_id
 * @property string $role
 * @property string $activity
 * @property string $as
 * @property string $theme
 * @property string $dateStart
 * @property string|null $dateEnd
 * @property string $organizer
 * @property string $location
 * @property array $table
 * @property int|null $number
 * @property string|null $month
 * @property int|null $year
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereAs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereOrganizer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResearchAssignment whereYear($value)
 * @mixin \Eloquent
 */
	class ResearchAssignment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Semester
 *
 * @property int $id
 * @property string $semester
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester query()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereSemester($value)
 * @mixin \Eloquent
 */
	class Semester extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StructuralPosition
 *
 * @property int $id
 * @property int|null $sdm_id
 * @property int|null $structure_id
 * @property-read \App\Models\HumanResource|null $humanReource
 * @property-read \App\Models\Structure|null $structure
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralPosition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralPosition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralPosition query()
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralPosition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralPosition whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StructuralPosition whereStructureId($value)
 * @mixin \Eloquent
 */
	class StructuralPosition extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Structure
 *
 * @property int $id
 * @property string $role
 * @property string $parent_id
 * @property string $child_id
 * @property string $type
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Structure> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HumanResource> $humanResource
 * @property-read int|null $human_resource_count
 * @property-read Structure|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|Structure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure query()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereChildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereType($value)
 * @mixin \Eloquent
 */
	class Structure extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $student_id
 * @property string|null $nama_lengkap
 * @property string|null $gender
 * @property string|null $tempat_tanggal_lahir
 * @property string|null $nim
 * @property string|null $password
 * @property string|null $nik
 * @property string|null $program_studi_id
 * @property string|null $sesi_kuliah
 * @property string|null $periode_masuk
 * @property string|null $angkatan
 * @property string|null $no_tes
 * @property string|null $status_masuk
 * @property string|null $jalur_masuk
 * @property string|null $tanggal_daftar
 * @property string|null $gelombang_pendaftaran
 * @property string|null $status_akademik
 * @property string|null $status_mahasiswa
 * @property string|null $agama
 * @property string|null $status_nikah
 * @property string|null $kewarganegaraan
 * @property string|null $status_domisili
 * @property string|null $alamat
 * @property string|null $kelurahan
 * @property string|null $kecamatan
 * @property string|null $kota_tinggal
 * @property string|null $kode_pos
 * @property string|null $negara
 * @property string|null $no_telp
 * @property string|null $no_hp
 * @property string|null $email
 * @property string|null $hubungan_biaya
 * @property string|null $sumber_dana_beasiswa
 * @property string|null $jumlah_saudara
 * @property string|null $jumlah_saudara_laki
 * @property string|null $jumlah_saudara_perempuan
 * @property string|null $status_bekerja
 * @property string|null $pekerjaan
 * @property string|null $institusi_kantor
 * @property string|null $jabatan
 * @property string|null $alamat_institusi_kantor
 * @property string|null $no_asuransi
 * @property string|null $hoby
 * @property string|null $tahu_kampus_ini_dari
 * @property string|null $nim_lama
 * @property string|null $pt_asal
 * @property string|null $tahun_masuk_pt_asal
 * @property string|null $nama_ayah
 * @property string|null $tanggal_lahir_ayah
 * @property string|null $status_ayah
 * @property string|null $tanggal_meniggal_ayah
 * @property string|null $pendidikan_ayah
 * @property string|null $pendidikan_terakhir_ayah
 * @property string|null $pekerjaan_ayah
 * @property string|null $nama_ibu
 * @property string|null $tanggal_lahir_ibu
 * @property string|null $status_ibu
 * @property string|null $tanggal_meninggal_ibu
 * @property string $created_at
 * @property string $updated_at
 * @property-read \App\Models\StudentDetail|null $detail
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereAgama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereAlamatInstitusiKantor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereAngkatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereGelombangPendaftaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereHoby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereHubunganBiaya($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereInstitusiKantor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereJalurMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereJumlahSaudara($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereJumlahSaudaraLaki($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereJumlahSaudaraPerempuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereKecamatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereKelurahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereKewarganegaraan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereKodePos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereKotaTinggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNamaAyah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNamaIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNamaLengkap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNegara($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNimLama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNoAsuransi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNoHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNoTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNoTes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePekerjaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePekerjaanAyah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePendidikanAyah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePendidikanTerakhirAyah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePeriodeMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereProgramStudiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePtAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereSesiKuliah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStatusAkademik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStatusAyah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStatusBekerja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStatusDomisili($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStatusIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStatusMahasiswa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStatusMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStatusNikah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereSumberDanaBeasiswa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereTahuKampusIniDari($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereTahunMasukPtAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereTanggalDaftar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereTanggalLahirAyah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereTanggalLahirIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereTanggalMeniggalAyah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereTanggalMeninggalIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereTempatTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Student withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
	class Student extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StudentDetail
 *
 * @property int $id
 * @property string $student_id
 * @property string|null $pendidikan_ibu
 * @property string|null $pendidikan_terakhir_ibu
 * @property string|null $pekerjaan_ibu
 * @property string|null $agama_orang_tua
 * @property string|null $warga_negara_orang_tua
 * @property string|null $alamat_orang_tua
 * @property string|null $kota_orang_tua
 * @property string|null $kode_pos_orang_tua
 * @property string|null $no_telp_orang_tua
 * @property string|null $email_orang_tua
 * @property string|null $orang_tua_mampu
 * @property string|null $penghasilan_orang_tua
 * @property string|null $jumlah_tanggungan
 * @property string|null $nama_wali
 * @property string|null $tanggal_lahir_wali
 * @property string|null $status_wali
 * @property string|null $tanggal_meninggal_wali
 * @property string|null $alamat_wali
 * @property string|null $kota_wali
 * @property string|null $kode_pos_wali
 * @property string|null $no_telp_wali
 * @property string|null $email_wali
 * @property string|null $pendidikan_wali
 * @property string|null $pendidikan_terakhir_wali
 * @property string|null $pekerjaan_wali
 * @property string|null $tahun_daftar_smta
 * @property string|null $tahun_lulus_smta
 * @property string|null $jurusan_smta
 * @property string|null $jenis_smta
 * @property string|null $nama_smta
 * @property string|null $alamat_smta
 * @property string|null $nisn
 * @property string|null $no_ijazah_smta
 * @property string|null $ijazah_smta
 * @property string|null $tanggal_ijazah_smta
 * @property string|null $status_smta
 * @property string|null $akreditasi_smta
 * @property string|null $nilai_ujian_akhir_smta
 * @property string|null $nama_pt_s1
 * @property string|null $status_pt_s1
 * @property string|null $fakultas_s1
 * @property string|null $jurusan_program_studi_s1
 * @property string|null $jalur_penyelesaian_studi_s1
 * @property string|null $ipk_yudisium_s1
 * @property string|null $tanggal_lulus_s1
 * @property string|null $beban_studi_sks_s1
 * @property string|null $nama_pt_s2
 * @property string|null $status_pt_s2
 * @property string|null $fakultas_s2
 * @property string|null $jurusan_program_studi_s2
 * @property string|null $jalur_penyelesaian_studi_s2
 * @property string|null $ipk_yudisium_s2
 * @property string|null $tanggal_lulus_s2
 * @property string|null $beban_studi_sks_s2
 * @property string $created_at
 * @property string $updated_at
 * @property-read \App\Models\Student|null $student
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereAgamaOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereAkreditasiSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereAlamatOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereAlamatSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereAlamatWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereBebanStudiSksS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereBebanStudiSksS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereEmailOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereEmailWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereFakultasS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereFakultasS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereIjazahSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereIpkYudisiumS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereIpkYudisiumS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJalurPenyelesaianStudiS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJalurPenyelesaianStudiS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJenisSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJumlahTanggungan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJurusanProgramStudiS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJurusanProgramStudiS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereJurusanSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereKodePosOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereKodePosWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereKotaOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereKotaWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNamaPtS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNamaPtS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNamaSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNamaWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNilaiUjianAkhirSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNisn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNoIjazahSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNoTelpOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereNoTelpWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereOrangTuaMampu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePekerjaanIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePekerjaanWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePendidikanIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePendidikanTerakhirIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePendidikanTerakhirWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePendidikanWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail wherePenghasilanOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereStatusPtS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereStatusPtS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereStatusSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereStatusWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTahunDaftarSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTahunLulusSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTanggalIjazahSmta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTanggalLahirWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTanggalLulusS1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTanggalLulusS2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereTanggalMeninggalWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentDetail whereWargaNegaraOrangTua($value)
 * @mixin \Eloquent
 */
	class StudentDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StudyProgram
 *
 * @property int $id
 * @property int|null $faculty_id
 * @property string $study_program
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyProgram whereStudyProgram($value)
 * @mixin \Eloquent
 */
	class StudyProgram extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subject
 *
 * @property int $id
 * @property string $subject
 * @property int $sks
 * @property int $number_of_meetings
 * @property int|null $class_id
 * @property int|null $semester_id
 * @property int|null $sdm_id
 * @property-read \App\Models\Classes|null $class
 * @property-read \App\Models\HumanResource|null $human_resource
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meeting> $meetings
 * @property-read int|null $meetings_count
 * @property-read \App\Models\Semester|null $semester
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereNumberOfMeetings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereSks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereSubject($value)
 * @mixin \Eloquent
 */
	class Subject extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $sdm_id
 * @property string|null $sdm_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $nidn
 * @property string|null $nip
 * @property string|null $active_status_name
 * @property string|null $employee_status
 * @property string|null $sdm_type
 * @property int|null $is_sister_exist
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int|null $program_studi_id
 * @property int|null $sdm_type_id
 * @property string|null $mac_address
 * @property-read LecturerDetail|null $detail
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presence> $presence
 * @property-read int|null $presence_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ResearchProposal> $researchProposal
 * @property-read int|null $research_proposal_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Structure> $structure
 * @property-read int|null $structure_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActiveStatusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmployeeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsSisterExist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMacAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNidn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProgramStudiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSdmName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSdmType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSdmTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Dedication> $dedication
 * @property-read int|null $dedication_count
 * @property-read mixed $name
 * @mixin \Eloquent
 */
	class User extends \Eloquent implements \Filament\Models\Contracts\FilamentUser {}
}

namespace App\Models\Wr3{
/**
 * App\Models\Wr3\Dedication
 *
 * @property int $id
 * @property int $sdm_id
 * @property string $role
 * @property string $as
 * @property string $theme
 * @property string $title
 * @property string $funding_source
 * @property string $funding_amount
 * @property string $proposal_file
 * @property string $start_date
 * @property string $end_date
 * @property string $location
 * @property mixed $participants
 * @property string $target_activity_outputs
 * @property string $public_media_publications
 * @property string $scientific_publications
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read HumanResource $humanResource
 * @property-read \App\Models\Wr3\LetterNumber|null $letterNumber
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereActivitySchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereAs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereFundingAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereFundingSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereProposalFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication wherePublicMediaPublications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereScientificPublications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereTargetActivityOutputs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereUpdatedAt($value)
 * @property string $report_file
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereReportFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dedication whereStartDate($value)
 * @mixin \Eloquent
 */
	class Dedication extends \Eloquent {}
}

namespace App\Models\Wr3{
/**
 * App\Models\Wr3\LecturerDetail
 *
 * @property int $id
 * @property int|null $sdm_id
 * @property int $faculty_id
 * @property int $study_program_id
 * @property string $expertise
 * @property string $theme
 * @property string|null $other_theme
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Faculty $faculty
 * @property-read HumanResource|null $humanResource
 * @property-read StudyProgram $studyProgram
 * @method static \Database\Factories\Wr3\LecturerDetailFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereExpertise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereOtherTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereSdmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereStudyProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class LecturerDetail extends \Eloquent {}
}

namespace App\Models\Wr3{
/**
 * App\Models\Wr3\LetterNumber
 *
 * @property int $id
 * @property int|null $proposal_id
 * @property int|null $dedication_id
 * @property string|null $number
 * @property string|null $month
 * @property string|null $year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LetterNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LetterNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LetterNumber query()
 * @method static \Illuminate\Database\Eloquent\Builder|LetterNumber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LetterNumber whereDedicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LetterNumber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LetterNumber whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LetterNumber whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LetterNumber whereProposalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LetterNumber whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LetterNumber whereYear($value)
 * @property string|null $accepted_date
 * @method static \Illuminate\Database\Eloquent\Builder|LetterNumber whereAcceptedDate($value)
 * @mixin \Eloquent
 */
	class LetterNumber extends \Eloquent {}
}

namespace App\Models\Wr3{
/**
 * App\Models\Wr3\ResearchProposal
 *
 * @property int $id
 * @property int|null $sdm_id
 * @property string $proposal_title
 * @property string $grant_scheme
 * @property string $start
 * @property string $end
 * @property string $location
 * @property mixed|null $participants
 * @property string $target_outcomes
 * @property string $proposal_file
 * @property string $application_status
 * @property string|null $contract_period
 * @property string|null $funding_amount
 * @property int $verification
 * @property string|null $publication_title
 * @property string|null $author_status
 * @property string|null $journal_name
 * @property string|null $publication_year
 * @property string|null $volume_number
 * @property string|null $publication_date_year
 * @property string|null $publisher
 * @property string|null $journal_accreditation_status
 * @property string|null $journal_publication_link
 * @property string|null $journal_pdf_file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read HumanResource|null $humanResource
 * @property-read \App\Models\Wr3\LetterNumber|null $letterNumber
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Participant> $participant
 * @property-read int|null $participant_count
 * @method static Builder|ResearchProposal export(?array $columns = null)
 * @method static \Database\Factories\Wr3\ResearchProposalFactory factory($count = null, $state = [])
 * @method static Builder|ResearchProposal newModelQuery()
 * @method static Builder|ResearchProposal newQuery()
 * @method static Builder|ResearchProposal query()
 * @method static Builder|ResearchProposal search(?string $keyword, array $columns = [], array $relations = [])
 * @method static Builder|ResearchProposal searchManual(?string $keyword)
 * @method static Builder|ResearchProposal whereApplicationStatus($value)
 * @method static Builder|ResearchProposal whereAuthorStatus($value)
 * @method static Builder|ResearchProposal whereContractPeriod($value)
 * @method static Builder|ResearchProposal whereCreatedAt($value)
 * @method static Builder|ResearchProposal whereEnd($value)
 * @method static Builder|ResearchProposal whereFundingAmount($value)
 * @method static Builder|ResearchProposal whereGrantScheme($value)
 * @method static Builder|ResearchProposal whereId($value)
 * @method static Builder|ResearchProposal whereJournalAccreditationStatus($value)
 * @method static Builder|ResearchProposal whereJournalName($value)
 * @method static Builder|ResearchProposal whereJournalPdfFile($value)
 * @method static Builder|ResearchProposal whereJournalPublicationLink($value)
 * @method static Builder|ResearchProposal whereLocation($value)
 * @method static Builder|ResearchProposal whereParticipants($value)
 * @method static Builder|ResearchProposal whereProposalFile($value)
 * @method static Builder|ResearchProposal whereProposalTitle($value)
 * @method static Builder|ResearchProposal wherePublicationDateYear($value)
 * @method static Builder|ResearchProposal wherePublicationTitle($value)
 * @method static Builder|ResearchProposal wherePublicationYear($value)
 * @method static Builder|ResearchProposal wherePublisher($value)
 * @method static Builder|ResearchProposal whereSdmId($value)
 * @method static Builder|ResearchProposal whereStart($value)
 * @method static Builder|ResearchProposal whereTargetOutcomes($value)
 * @method static Builder|ResearchProposal whereUpdatedAt($value)
 * @method static Builder|ResearchProposal whereVerification($value)
 * @method static Builder|ResearchProposal whereVolumeNumber($value)
 * @method static Builder|ResearchProposal workHours()
 * @mixin \Eloquent
 */
	class ResearchProposal extends \Eloquent {}
}

