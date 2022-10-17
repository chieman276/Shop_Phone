<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function websiteProduct()
    {
        $products = Product::all();
        $param = [
            'products' => $products,
        ];
        return view('frontend.website.product', $param);
    }


    public function showProduct($id)
    {
        $showProduct = Product::find($id);
        $params = [
            'showProduct' => $showProduct
        ];
        return view('frontend.website.detail', $params);
    }


    
    public function cart()
    {
        return view('frontend.website.cart');
    }


    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);


        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [

                "id" => $product->id,
                "productName" => $product->productName,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }


    public function update(Request $request)

    {

        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cập nhật giỏ hàng thành công!');
        }
    }

  

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Xóa sản phẩm thành công!');
        }
    }


    public function checkout()
    {
        return view('frontend.website.checkout');
    }
    
    public function orders()
    {
        $sum_product = session('cart');
        $user =  Auth::user();
        foreach ($sum_product as $id_product){
            $orders['user_id'] = $user->id;
            $orders['product_id'] = $id_product['id'];
            DB::table('orders')->insert($orders);
        }
        $products = session('cart');
        foreach ($products as $product){
            unset($products[$product['id']]);
            session()->put('cart', $products);
        }
        session()->flash('success', 'Giao dịch thành công!');
        
    }

    public function remove_all_product()
    {
        $products = session('cart');
        foreach ($products as $product){
            unset($products[$product['id']]);
            session()->put('cart', $products);
        }
        return redirect()->route('cart')->with('success', 'Xóa thành công');
    }


    //API
    public function products()
    {
        $products = Product::all();
        $param = [
            'products' => $products,
        ];
         return response()->json($param, 200);
        // return view('frontend.website.product', $param);
    }
    public function products_store(Request $request)
    {
        $product = new Product();
        $product->productName = $request->productName;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->price = $request->price;
        $product->save();
        
        $param = [
            'products' => $product,
        ];
         return response()->json($param, 200);
        // return view('frontend.website.product', $param);
    }
    
}
