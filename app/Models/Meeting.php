<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

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
class Meeting extends Model
{
    use HasFactory;

    protected $fillable = ["subject_id", "meeting_name", "date", "meeting_start", "file"];

    public $timestamps = false;

    public function url()
    {
        return $this->hasOne(Link::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public static function bulkCreateMeetings($subject_id, $numberOfMeetings)
    {
        $numbers = range(1, $numberOfMeetings);
        $newNumbers = array_map(function ($number) use ($subject_id) {
            return [
                "subject_id" => $subject_id,
                "meeting_name" => "Pertemuan ke " . $number,
                "date" => null
            ];
        }, $numbers);

        self::insert($newNumbers);
    }

    public static function upload($request, $name)
    {
        if ($request->hasFile($name)) {
            $file = $request->file($name);
            $originalFileName = $file->getClientOriginalName();
            $fileName = uniqid() . time() . $originalFileName . '.' . $file->extension();
            $file->move(public_path('presense/meetings'), $fileName);
            if (!File::exists(public_path('presense/meetings/' . $fileName))) return false;
            return $fileName;
        } else {
            return false;
        }
    }
}
