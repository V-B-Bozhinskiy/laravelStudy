<?php

use App\Models\Category;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/
Artisan::command('massInsert', function () {
    $categories = [
        [
            'name' => 'Видеокарты',
            'description' => 'test1',
            'created_at' => date('Y-m-d H:i:s'), // Массовое создание записей БД не создаёт created_at автоматически
        ],
        [
            'name' => 'Процессоры',
            'description' => 'test2',
            'created_at' => date('Y-m-d H:i:s'), // Массовое создание записей БД не создаёт created_at автоматически
        ]
    ];
    Category::insert($categories);
});

Artisan::command('updateCategory', function () {
    Category::where('id',1)->update([ //1 это id = 1
        'name' => 'Процессоры'
    ]); 
});

Artisan::command('deleteCategory', function () {
    Category::where('id',1)->delete(); //1 это id = 1
});

Artisan::command('deleteAllCategories', function () {
    Category::whereNotNull('id')->delete(); 
});

Artisan::command('createCategory', function () {
    $category = new Category([
        'name' => 'Видеокарты',
        'description' => "RTX 3050 
(Не надо. 
 Не надо давать мне надежду...)"
    ]);
    $category->save();
    dd($category);
});

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
