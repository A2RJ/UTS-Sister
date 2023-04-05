<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Structure extends Model
{
    use HasFactory;

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

    public static function getStructureIds($structureIds, $justChild = false)
    {
        $sessionKey = 'ids';
        if (Session::has($sessionKey)) return Session::get($sessionKey);

        $structures = Structure::whereIn('id', $structureIds)->with('ancestors')->get();
        if (!$structures->count()) {
            return [];
        }
        $result = [];
        foreach ($structures as $structure) {
            $structure->childIdsRecursive($result, $justChild);
        }

        Session::put($sessionKey, $result);

        return $result;
    }

    public function childIdsRecursive(&$result, $justChild)
    {
        if ($justChild) {
            if ($this->ancestors) {
                $result[] = $this->ancestors->id;
                $this->ancestors->childIdsRecursive($result, $justChild);
            }
        } else {
            $result[] = $this->id;
            if ($this->ancestors) {
                $this->ancestors->childIdsRecursive($result, $justChild);
            }
        }
    }

    public static function getOwnStructure()
    {
        return Auth::user()->structure;
    }

    public static function getOwnStructureIds()
    {
        $structure = self::getOwnStructure();
        return collect($structure)->pluck('id');
    }

    public static function getAllStructure($structureIds)
    {
        return Structure::whereIn('id', $structureIds)->with('ancestors')->get();
    }

    public static function getAllSdmIds($structureIds, $justChild = false)
    {
        $allIds = self::getStructureIds($structureIds, $justChild);

        $sdmIds = Structure::join('structural_positions', 'structures.id', '=', 'structural_positions.structure_id')
            ->join('human_resources', 'structural_positions.sdm_id', '=', 'human_resources.id')
            ->whereIn('structures.id', $allIds)
            ->select('human_resources.id')
            ->pluck('human_resources.id')
            ->toArray();

        return $sdmIds;
    }

    public static function getStructureWithSdm($structureIds, $justChild = false, $table = false)
    {
        $allIds = self::getStructureIds($structureIds, $justChild);

        if ($table) {
            $structure = Structure::whereIn('id', $allIds)
                ->with('humanResource')
                ->get();
        } else {
            $structure = Structure::join('structural_positions', 'structures.id', '=', 'structural_positions.structure_id')
                ->join('human_resources', 'structural_positions.sdm_id', '=', 'human_resources.id')
                ->whereIn('structures.id', $allIds)
                ->get();
        }
        return $structure;
    }

    public static function childSdmIds($justChild)
    {
        $structureId = Structure::getOwnStructureIds();
        $sdmIds = Structure::getAllSdmIds($structureId, $justChild);
        return $sdmIds;
    }

    public static function isMySub($sdmId)
    {
        $sdmIds = Structure::childSdmIds(false);
        return in_array($sdmId, $sdmIds);
    }
}
