<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
class PresenceAttachment extends Model
{
    use HasFactory;

    public $table = "presence_attachment";
    public $timestamps = false;
    protected $fillable = ['presence_id', 'detail', 'attachment'];
}
