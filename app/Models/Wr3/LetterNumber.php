<?php

namespace App\Models\Wr3;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @mixin \Eloquent
 */
class LetterNumber extends Model
{
    use HasFactory;

    protected $fillable = ['proposal_id', 'dedication_id', 'number', 'month', 'year', 'accepted_date'];
}
