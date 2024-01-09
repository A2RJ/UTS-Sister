<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auth\Structures\StructureTrait;
use App\Traits\Auth\Structures\UtilsStructure;

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
class Structure extends Model
{
    use HasFactory, StructureTrait, UtilsStructure;

    // Visualize json to flowcart https://vanya.jp.net/vtree/
    public static $roles = [];

    protected $fillable = ["role", "parent_id", "child_id", 'type'];

    public $timestamps = false;

    public static function types()
    {
        return collect(['struktural', 'fakultas', 'prodi', 'dosen'])->map(function ($type) {
            return [
                'value' => $type,
                'text' => $type
            ];
        });
    }

    public function humanResource()
    {
        return $this->hasManyThrough(
            HumanResource::class,
            StructuralPosition::class,
            'structure_id',
            'id',
            'id',
            'sdm_id'
        );
    }

    public static function search()
    {
        $search = request('search');
        $query = Structure::whereNot('parent_id', 'none')
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('role', 'LIKE', "%$search%")
                        ->orWhereHas('humanResource', function ($q) use ($search) {
                            $q->where('sdm_name', 'LIKE', "%$search%");
                        });
                });
            })
            ->with('humanResource')
            ->paginate()
            ->appends(request()->except('page'));

        return $query;
    }

    public static function selectOption()
    {
        return self::select("child_id as value", "role as text")->get();
    }

    public static function selectOptionStructure()
    {
        return self::select("id as value", "role as text")->get();
    }

    public static function studyOption()
    {
        return collect(self::where('type', 'prodi')->get())->map(function ($item) {
            return [
                'value' => $item['id'],
                'text' => $item['role']
            ];
        });
    }

    public static function fakultasOption()
    {
        return collect(self::where('type', 'fakultas')->get())->map(function ($item) {
            return [
                'value' => $item['id'],
                'text' => $item['role']
            ];
        });
    }

    public function children()
    {
        return $this->hasMany(Structure::class, 'parent_id', 'child_id');
    }

    public function parent()
    {
        return $this->belongsTo(Structure::class, 'child_id', 'parent_id');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }
}
