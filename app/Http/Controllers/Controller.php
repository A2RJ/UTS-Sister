<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresenceMahasiswa;
use App\Models\Comment;
use App\Models\Link;
use App\Models\Meeting;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public $isApi = false;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request)
    {
        if ($request->route()) {
            $this->isApi = Str::contains($request->route()->getPrefix(), "api/");
        }
    }

    public function response($data, $view = false)
    {
        return $this->isApi ? response($data) : $view;
    }

    public function responseRedirect($data)
    {
        return $this->isApi ? response(["message" => $data]) : back()->with("message", $data);
    }

    public function index()
    {
        // Sister::authorize();
        return view('auth.login');
    }

    public function verify(Request $request)
    {
        $url = env('APP_REDIRECT') . "/verify?sharer=" . request('sharer') . "&is=" . request('is');
        $link = Link::where('link', $url)->first();
        abort_if(empty($link), 404, 'Ops invalid url');
        $meeting = Meeting::where('id', $link->meeting_id)->first();
        return view('mahasiswa.presence')
            ->with('id', uniqid())
            ->with('url', $url)
            ->with('meeting', $meeting->meeting_name);
    }

    public function presenceMahasiswa(PresenceMahasiswa $request)
    {
        $form = $request->safe()->only(['nama', 'nim', 'komentar']);
        $url = $request->url;
        $link = Link::where('link', $url)->first();
        abort_if(empty($link), 404, 'Ops invalid url');
        $form['meeting_id'] = $link->meeting_id;
        Comment::create($form);
        return redirect()->back()->with('message', 'Berhasil');
    }

    public function allComments()
    {
        $search = request('search');
        $comments = Comment::join('meetings', 'comments.meeting_id', 'meetings.id')
            ->join('subjects', 'meetings.subject_id', 'subjects.id')
            ->join('human_resources', 'subjects.sdm_id', 'human_resources.id')
            ->select('subject', 'comments.*', 'sdm_name')
            ->when($search, function ($query) use ($search) {
                $query->where('subject', 'like', '%' . $search . '%')
                    ->orWhere('sdm_name', 'like', '%' . $search . '%')
                    ->orWhere('meeting_id', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('nim', 'like', '%' . $search . '%')
                    ->orWhere('komentar', 'like', '%' . $search . '%');
            })
            ->paginate();


        return view('admin.comment.index')
            ->with('comments', $comments);
    }
}
