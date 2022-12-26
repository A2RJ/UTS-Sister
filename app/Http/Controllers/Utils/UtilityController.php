<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Support\Facades\Route as FacadesRoute;

class UtilityController extends Controller
{
    public function routes()
    {
        // $routes = collect(FacadesRoute::getRoutes())->map(function ($route) {
        //     return [
        //         "method" => $route->methods() ? json_encode($route->methods()) : "-",
        //         "uri" => $route->uri() ? $route->uri() : "-",
        //         "name" => $route->getName() ? $route->getname() : "-",
        //         "action" => $route->getActionName() ? $route->getActionName() : "-"
        //     ];
        // });
        // Route::truncate();
        // Route::insert($routes->toArray());
        // return response(["message" => true]);
    }

    public function routeList()
    {
        // $routes = Route::all();
        // return view('admin.routes.index', compact('routes'));
    }
}
