<?php

namespace App\Http\Controllers;

use App\Services\Sister;
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
        Sister::authorize();
        return view('welcome');
    }
}
