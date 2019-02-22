<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Categories;

class CrawlCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl the Categories from Chumbak API.';

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
        echo "\nCrawling Started";
        try {
            // Read the categories.
            $source = "https://api-cdn.chumbak.com/v1/women-apparel/GY1/c/";
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $source, ['verify' => false])->getBody()->getContents();
            $response = json_decode($response);
            if($response->status==200){
                if(count($response->hierarchy)>0){
                    foreach($response->hierarchy as $category){
                        $this->prepareCategories($category);
                    }
                }
            }else{
                echo "\nAPI is not responding.";
            }
        } catch (\Throwable $th) {
            echo "\nOperation terminated.";
        }
        echo "\nCrawling Completed.\n";
    }

    public function prepareCategories($category, $parent_id=0){
        try {
            $data = array(
                "id" => $category->id,
                "name" => $category->name,
                "parent_id" => $parent_id,
            );
            $cat = Categories::find($category->id);
            if ( is_null($cat) ) {
                Categories::insert($data);
            }else{
                $cat->name = $category->name;
                $cat->parent_id = $parent_id;
                try {
                    $cat->save();
                } catch (\Throwable $th) {
                    // throw $th;
                }
            }
            if($category->sub_categories!=null && count($category->sub_categories)>0){
                foreach($category->sub_categories as $subcategory){
                    $this->prepareCategories($subcategory,$category->id);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
