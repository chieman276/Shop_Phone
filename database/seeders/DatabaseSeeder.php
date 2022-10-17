<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->importUsers();
        $this->importProducts();
    }

    public function importUsers()
    {
        // $table->string('userName');
        // $table->string('email');
        // $table->string('phone');
        // $table->date('birthday');
        // $table->string('password')
        $user = new User();
        $user->userName = 'AnMC';
        $user->email = 'an@gmail.com';
        $user->password = Hash::make('123456');
        $user->birthday = '2003/06/27';
        $user->phone = '0916663273';
        $user->save();


        $user = new User();
        $user->userName = 'tenten';
        $user->email = 'tenten@gmail.com';
        $user->password = Hash::make('123456');
        $user->birthday = '1999/06/22';
        $user->phone = '01235435566';
        $user->save();


        $user = new User();
        $user->userName = 'Facebook';
        $user->email = 'facebook@gmail.com';
        $user->password = Hash::make('123456');
        $user->birthday = '1995/06/27';
        $user->phone = '012354345444';
        $user->save();


        $user = new User();
        $user->userName = 'youtube';
        $user->email = 'youtube@gmail.com';
        $user->password = Hash::make('123456');
        $user->birthday = '1999/06/23';
        $user->phone = '0576879345';
        $user->save();
    }


    public function importProducts()
    {
        $product = new Product();
        $product->productName = 'Iphone 12 ProMax xanh dương';
        $product->description = 'iPhone 12 Pro Max 128 GB một siêu phẩm smartphone đến từ Apple. Máy có một hiệu năng hoàn toàn mạnh mẽ đáp ứng tốt nhiều nhu cầu đến từ người dùng và mang trong mình một thiết kế đầy vuông vức, sang trọng.';
        $product->image = "https://cdn.tgdd.vn/Files/2020/10/14/1298715/2_470x556.jpg";
        $product->price = '27456000';
        $product->save();



        $product = new Product();
        $product->productName = 'Điện thoại iPhone 13 Pro Max 256GB';
        $product->description = 'Điện thoại iPhone 13 Pro Max 256GB một siêu phẩm smartphone đến từ Apple. Máy có một hiệu năng hoàn toàn mạnh mẽ đáp ứng tốt nhiều nhu cầu đến từ người dùng và mang trong mình một thiết kế đầy vuông vức, sang trọng.';
        $product->image = "https://www.techone.vn/wp-content/uploads/2021/09/22-1-500x500.jpg";
        $product->price = '25190000';
        $product->save();


        $product = new Product();
        $product->productName = 'Iphone 14 Pro 1TB';
        $product->description = 'Iphone 14 Pro 1TB một siêu phẩm smartphone đến từ Apple. Máy có một hiệu năng hoàn toàn mạnh mẽ đáp ứng tốt nhiều nhu cầu đến từ người dùng và mang trong mình một thiết kế đầy vuông vức, sang trọng.';
        $product->image = "https://cdn.tgdd.vn/Products/Images/42/289696/iphone-14-pro-tim-thumb-600x600.jpg";
        $product->price = '44990000';
        $product->save();

        $product = new Product();
        $product->productName = 'IPhone 14 Pro 256GB';
        $product->description = 'iPhone 14 Pro 256GB một siêu phẩm smartphone đến từ Apple. Máy có một hiệu năng hoàn toàn mạnh mẽ đáp ứng tốt nhiều nhu cầu đến từ người dùng và mang trong mình một thiết kế đầy vuông vức, sang trọng.';
        $product->image = "https://cdn.tgdd.vn/Products/Images/42/289691/iphone-14-pro-vang-thumb-600x600.jpg";
        $product->price = '44990000';
        $product->save();

        $product = new Product();
        $product->productName = 'Iphone 12 Pro';
        $product->description = 'iPhone 12 Pro một siêu phẩm smartphone đến từ Apple. Máy có một hiệu năng hoàn toàn mạnh mẽ đáp ứng tốt nhiều nhu cầu đến từ người dùng và mang trong mình một thiết kế đầy vuông vức, sang trọng.';
        $product->image = "https://cdn.tgdd.vn/Products/Images/42/230521/iphone-13-pro-thumb-600x600.jpg";
        $product->price = '27490000';
        $product->save();

        $product = new Product();
        $product->productName = 'Iphone 13';
        $product->description = 'iPhone 13 một siêu phẩm smartphone đến từ Apple. Máy có một hiệu năng hoàn toàn mạnh mẽ đáp ứng tốt nhiều nhu cầu đến từ người dùng và mang trong mình một thiết kế đầy vuông vức, sang trọng.';
        $product->image = "https://cdn.tgdd.vn/Products/Images/42/223602/iphone-13-pink-2-600x600.jpg";
        $product->price = '19690000';
        $product->save();



        $product = new Product();
        $product->productName = 'OPPO A77';
        $product->description = 'OPPO A77 (Sky Blue, 4GB RAM, 64 Storage) with No Cost EMI/Additional Exchange Offers.';
        $product->image = "https://m.media-amazon.com/images/I/81BtVJkyYOL._SX679_.jpg";
        $product->price = '15490000';
        $product->save();

        $product = new Product();
        $product->productName = 'I KALL Z8 4G Smartphone';
        $product->description = 'I KALL Z8 4G Smartphone (5.5 Inch, 3GB, 16GB) (4G Volte) (Cyan).';
        $product->image = "https://m.media-amazon.com/images/I/41ts9oeBLeL._SX300_SY300_QL70_FMwebp_.jpg";
        $product->price = '1466000';
        $product->save();


        $product = new Product();
        $product->productName = 'I KALL Z5 Smartphone ';
        $product->description = 'I KALL Z5 Smartphone (3GB, 16GB, Dual Sim) (Pink).';
        $product->image = "https://m.media-amazon.com/images/I/512vw5cXH+L._SY741_.jpg";
        $product->price = '14460000';
        $product->save();

        
        $product = new Product();
        $product->productName = 'Lava Z21';
        $product->description = 'Lava Z21 (2GB RAM, 32GB ROM)-Blue| Octa Core Processor| Stock Android 11| Powerful 3100 mAh Battery.';
        $product->image = "https://m.media-amazon.com/images/I/71gWzvbGHtL._SX679_.jpg";
        $product->price = '1529000';
        $product->save();


        $product = new Product();
        $product->productName = 'Redmi 9 Activ';
        $product->description = 'Redmi 9 Activ (Metallic Purple, 4GB RAM, 64GB Storage) | Octa-core Helio G35 | 5000 mAh Battery.';
        $product->image = "https://m.media-amazon.com/images/I/919IyPIfczL._SX679_.jpg";
        $product->price = '18099000';
        $product->save();
        $product = new Product();
        $product->productName = 'Lava Z3 Pro';
        $product->description = 'Lava Z3 Pro (3GB RAM, 32GB Storage)- Blue | High Performance Octa core Processor| Big 5000 mAh Battery | 8MP AI Dual Rear Camera.';
        $product->image = "https://m.media-amazon.com/images/I/41wxx1TWZOL._SX300_SY300_QL70_FMwebp_.jpg";
        $product->price = '16666000';
        $product->save();


    }
}
