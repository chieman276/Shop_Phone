<?php

namespace App\Http\Controllers;


use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Excel;

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


    public function update_product(Request $request)

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


    public function index()
    {
        $products = Product::all();
        $params = [
            'products' => $products,
        ];
        return view('admin.products.index', $params);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $product = new Product();
        $product->productName = $request->productName;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->price = $request->price;
        try {
            $product->save();
            return redirect()->route('products.index')->with('success', 'Sửa' . ' ' . $request->productName . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', 'Sửa' . ' ' . $request->productName . ' ' .  'không thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $params = [
            'product' => $product,
        ];
        return view('admin.products.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->productName = $request->productName;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->price = $request->price;
        
        $product->save();
        return redirect()->route('products.index')->with('success', 'Sửa' . ' ' . $request->productName . ' ' .  'thành công');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Xóa' . ' ' .  'thành công');;
    }

    public function export()
    {
        return FacadesExcel::download(new ProductExport, 'product.xlsx');
    }

    public function import()
    {
        try {
            FacadesExcel::import(new ProductImport,request()->file('file'));
            return back();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Vui lòng chọn File');
        }
    }
    

   
}
