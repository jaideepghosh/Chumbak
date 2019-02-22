<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Products;
use App\Categories;

class CrawlProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl the Products from Chumbak API.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $categories = Categories::all();
        if(!is_null($categories)){
            foreach($categories as $category){
                // Read the categories.
                $source = "https://api-cdn.chumbak.com/v1/category/{$category->id}/products/";
                $client = new \GuzzleHttp\Client();
                try {
                    echo "\nReading products from ".$category->name." category.";
                    $response = $client->request('GET', $source, ['verify' => false])->getBody()->getContents();
                    $response = json_decode($response);
                    if(count($response->products)){
                        foreach($response->products as $product){
                            // Check if the product exists in database.
                            $prod = Products::find($product->entity_id);
                            if ( is_null($prod) ) {
                                $data = array(
                                    "id"                    =>  $product->entity_id,
                                    "name"                  =>  $product->title,
                                    "category"              =>  $product->primary_category_id,
                                    "price"                 =>  $product->price,
                                    "special_price"         =>  0,
                                    "is_special_price"      =>  $product->is_special_price,
                                    "is_sale_flag"          =>  $product->is_sale_flag,
                                    "image_aspectratio_code"=>  $product->image_aspectratio_code
                                );
                                if($product->is_special_price){
                                    $data["special_price"] = $product->price;
                                }
                                Products::insert($data);
                            }else{
                                $prod->id                       =  $product->entity_id;
                                $prod->name                     =  $product->title;
                                $prod->category                 =  $product->primary_category_id;
                                $prod->price                    =  $product->price;
                                $prod->special_price            =  ($prod->is_special_price)?$product->price:0;
                                $prod->is_special_price         =  $product->is_special_price;
                                $prod->is_sale_flag             =  $product->is_sale_flag;
                                $prod->image_aspectratio_code   =  $product->image_aspectratio_code;
                                $prod->save();
                            }
                        }
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
    }
}
