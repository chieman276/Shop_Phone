<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add_product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */

    public function handle()
    {
        $response = Http::get('http://127.0.0.1:8000/api/products');
        $products = $response->body();
        if (isset($products)) {
            $products = json_decode($products, true);
            $products = ($products['products']);
            foreach ($products as $data => $product) {
                $add_products['productName'] = $product['productName'];
                $add_products['description'] = $product['description'];
                $add_products['image'] = $product['image'];
                $add_products['price'] = $product['price'];
                DB::table('products')->insert($add_products);
            }
        }
    }
}
