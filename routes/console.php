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
Artisan::command('parceEkatalog', function () {
    $i = 0;
    do {
        $url = 'https://www.e-katalog.ru/ek-list.php?katalog_=189&search_=rtx+3090';
        if ($i > 0){
            $url = $url."&page_=$i";
        }
        //$url = 'https://yandex.ru';

        $data = file_get_contents($url);

        //dd($data);

        $dom = new DomDocument();
        @$dom->loadHTML($data); // @-это оператор игнорирования ошибки при операции

        $xpath = new DOMXPath($dom);
        $divs = $xpath->query("//div[@class='model-short-div list-item--goods   ']");
        //dd($divs);

        if ($i == 0){
            try{
            $totalProductsString = $xpath->query("//span[@class='t-g-q']")[0]->nodeValue ?? false;

            preg_match_all('/\d+/', $totalProductsString, $matches);
            
            $totalProducts = (int) $matches[0][0];

            dump($totalProducts);
            $productsOnOnePage = $divs->length;
            $pages = ceil($totalProducts / $productsOnOnePage);
            dump($pages);
            } catch (Exception $e){
                $pages = 0;
            }
            $products = [];
        }

        foreach ($divs as $div){
            $a = $xpath->query("descendant::a[@class='model-short-title no-u']", $div);
            $name = $a[0]->nodeValue;

            $price = 0;
            $ranges = $xpath->query("descendant::div[@class='model-price-range']", $div);
            if ($ranges->length == 1){
                foreach ($ranges[0]->childNodes as $child){
                    if ($child->nodeName == 'a'){
                        $price = $child->nodeValue; 
                    }
                }
            }
            $ranges = $xpath->query("descendant::div[@class='pr31 ib']", $div);
            if ($ranges->length == 1){
                $price = $ranges[0]->nodeValue;
            }
            dump("$name: $price");
            $products[] = [
                'name' => $name,
                'price' => $price
            ];
        }
    $i++;
    } while ($i<$pages);
    
    //Создание файла по результату парсинга
    $file = fopen('videocards.csv', 'w',);
    foreach ($products as $product){
        fputcsv($file, $product, ';');
    } 
    fclose($file);
});

Artisan::command('importCategoriesFromFile', function () {
    $file = fopen('categories.csv','r');

    $i = 0;
    $insert = [];
    while ($row = fgetcsv($file, 1000,';')){
        if ($i++ == 0){
            $bom = pack('H*','EFBBBF');               //Удаление невидимого символа в csv, 
            $row = preg_replace("/^$bom/", '', $row); //который ломает сохранение в БД
            $columns = $row;
            continue;
        }
        //dump($columns);

        $data = array_combine($columns,$row);
        //dump($data);

        $data['created_at'] = date('Y-m-d H:i:s'); 
        $data['updated_at'] = date('Y-m-d H:i:s');
        $insert[] = $data;
    }
    //dd($insert);
    Category::insert($insert);
});

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
