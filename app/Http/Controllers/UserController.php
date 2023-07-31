<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Itstructure\GridView\DataProviders\EloquentDataProvider;
use App\Http\Services\UsersService;

class UserController extends Controller
{
    public function __invoke()
    {
        $service = new UsersService;
        $dataProvider = $service->getGridTableUsers();

        return view('users', compact('dataProvider'));

    }
}
