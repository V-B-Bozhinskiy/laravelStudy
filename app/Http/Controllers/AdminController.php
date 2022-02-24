<?php

namespace App\Http\Controllers;

use App\Jobs\ExportCategories;
use App\Jobs\ExportProducts;
use App\Jobs\ImportCategoties;
use App\Jobs\ImportProducts;
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

    public function exportProducts()
    {
        ExportProducts::dispatch();
        session()->flash('startExportProducts');
        return back();
    }

    public function importCategories()
    {
        request()->validate([
            'file' => 'required|mimes:csv,txt'
        ]);
        $input = request()->all();
        $file = $input['file'];
        $ext = $file->getClientOriginalExtension();
        $filename = time() . rand(10000,99999) . '.' . $ext;
        $file->storeAs('public/categories/importFiles',$filename);
        //dd(Auth::user()->id);
        ImportCategoties::dispatch("storage/app/public/categories/importFiles/${filename}",Auth::user()->id);
        session()->flash('startImportCategories');
        return back();
    }

    public function importProducts()
    {   
        request()->validate([
            'file' => 'required|mimes:csv,txt'
        ]);
        $input = request()->all();
        $file = $input['file'];
        $ext = $file->getClientOriginalExtension();
        $filename = time() . rand(10000,99999) . '.' . $ext;
        $file->storeAs('public/products/importFiles',$filename);
        ImportProducts::dispatch("storage/app/public/products/importFiles/${filename}");
        session()->flash('startImportProducts');
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

    public function addProduct(){
        request()->validate([
            'name' => 'required|min:3',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'picture' => 'mimes:jpg,bmp,webp|nullable'
        ]);
        $input = request()->all();
        $name = $input['name'];
        $description = $input['description'];
        $picture = $input['picture'] ?? null;
        $price = $input['price'];
        $category_id = $input['category_id'];
        $newProduct = Product::create([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $category_id
        ]);
        if ($picture){
            $ext = $picture->getClientOriginalExtension();
            $filename = time() . rand(10000,99999) . '.' . $ext;
            $picture->storeAs('public/products',$filename);
            $newProduct->picture = "products/$filename";
        }

        $newProduct->save();
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
        $users = User::get();
        $data = [
            'orders' => $orders,
            'users' => $users
        ];
        return view('admin.orders',$data);
    }
}
