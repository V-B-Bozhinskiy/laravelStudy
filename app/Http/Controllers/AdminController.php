<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {
        return view('admin.admin');
    }

    public function users()
    {
        $data = [
            'title' => 'Список пользователей',
            'number' => 10,
            'numbers' => [1,3,5,7],
            'cities' => [],
        ];
        return view('admin.users',$data);
    }

    public function products()
    {
        return view('admin.products');
    }
    
    public function categories()
    {
        return view('admin.categories');
    }
}
