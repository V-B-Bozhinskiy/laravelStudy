<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin()
    {
        return view('admin.admin');
    }

    public function users()
    {
        $users = User::get();
        //dd($users); //dump and die = Вывести дамп переменной и завершить выполнение скрипта.

        $data = [
            'title' => 'Список пользователей',
            'number' => 10,
            'numbers' => [1,3,5,7],
            'cities' => [],
            'users' => $users,
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

    public function enterAsUser($id)
    {
        Auth::loginUsingId($id);
        return redirect()->route('home');
    }
}
