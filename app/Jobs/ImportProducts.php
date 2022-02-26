<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ImportProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fileSource;
    protected $userId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fileSource,$userId)
    {
        $this->fileSource = $fileSource;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Auth::loginUsingId($this->userId);
        //dd($this->fileSource);
        $file = fopen($this->fileSource,'r');

        $i = 0;
        $insertWithId = [];
        $insertWithoutId = [];
        while ($row = fgetcsv($file, 1000,';')){
            if ($i++ == 0){
                $bom = pack('H*','EFBBBF');               //Удаление невидимого символа в csv, 
                $row = preg_replace("/^$bom/", '', $row); //который ломает сохранение в БД
                $columns = $row;
                continue;
            }
            dump($columns);

            $data = array_combine($columns,$row);
            dump($data);
            if (array_key_exists('id',$data)){
                if ($data['id'] != ''){
                    $findProduct = Product::find($data['id']);
                    //dump($findProduct);
                    if ($findProduct){
                        $data['updated_at'] = date('Y-m-d H:i:s');
                        dump('update');
                        //$updateData = [];
                        //foreach ($columns as $column){
                        //    dump($column);
                        //    dump($findProduct[$column]);
                        //    dump($data[$column]);
                        //    if ($findProduct[$column] != $data[$column]){
                        //        $updateData[$column] = $data[$column];
                        //    }
                        //}
                        //dump($updateData);
                        $findProduct->update($data);
                    } else {
                        dump('create 1');
                        $data['created_at'] = date('Y-m-d H:i:s'); 
                        $data['updated_at'] = date('Y-m-d H:i:s');
                        $insertWithId[] = $data;
                    }
                } else { //Если строка с id пустая то считаем новым объектом
                    dump('create 2');
                    $data['created_at'] = date('Y-m-d H:i:s'); 
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    unset($data['id']);
                    $insertWithoutId[] = $data;
                }
            } else {
                dump('create 3');
                $data['created_at'] = date('Y-m-d H:i:s'); 
                $data['updated_at'] = date('Y-m-d H:i:s');
                $insertWithoutId[] = $data;
            }
        }
        //dd($insert);
        dump('create insertWithId');
        Product::insert($insertWithId);
        dump('create insertWithoutId');
        Product::insert($insertWithoutId);
    }

    public function failed(){
        Log::error('Job ImportProducts failed!');
    }
}
