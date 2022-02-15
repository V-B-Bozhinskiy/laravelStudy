<?php

namespace App\Http\Controllers;

use App\Jobs\ExportCategories;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
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
        $roles = Role::get();
        //dd($users); //dump and die = Вывести дамп переменной и завершить выполнение скрипта.

        $data = [
            'title' => 'Список пользователей',
            'number' => 10,
            'numbers' => [1,3,5,7],
            'cities' => [],
            'users' => $users,
            'roles' => $roles,
        ];
        return view('admin.users',$data);
    }

    public function products()
    {   
        $products = Product::get();
        $categories = Category::get();
        return view('admin.products', compact('products','categories'));
    }
    
    public function categories()
    {
        $categories = Category::get();
        return view('admin.categories', compact('categories'));
    }

    public function enterAsUser($id)
    {
        Auth::loginUsingId($id);
        return redirect()->route('home');
    }

    public function exportCategories()
    {
        ExportCategories::dispatch();
        session()->flash('startExportCategories');
        return back();
    }

    public function addCategory()
    {
        $input = request()->all();
        $name = $input['name'];
        $description = $input['description'];
        $picture = $input['picture'] ?? null;

        request()->validate([
            'name' => 'required|min:3',
            'description' => 'required',
            'picture' => 'mimes:jpg,bmp,webp|nullable'
        ]);

        $newCategory = Category::create([
            'name' => $name,
            'description' => $description
        ]);

        if ($picture){
            $ext = $picture->getClientOriginalExtension();
            $filename = time() . rand(10000,99999) . '.' . $ext;
            $picture->storeAs('public/categories',$filename);
            $newCategory->picture = "categories/$filename";
        }

        $newCategory->save();
        return back();
    }

    public function addRole()
    {   
        request()->validate([
            'name' => 'required|min:3',
        ]);

        Role::create([
            'name' => request('name')
        ]);
        return back();
    }

    public function addRoleToUser()
    {   
        request()->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);

        $user = User::find(request('user_id'));
        $user->roles()->attach(Role::find(request('role_id')));
        return back();
    }

    public function orders(){
        $orders = Order::get();
        $data = [
            'orders' => $orders
        ];
        return view('admin.orders',$data);
    }
}
