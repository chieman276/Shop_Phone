<?php

namespace App\Http\Controllers;


use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use App\Exports\ProductExport;
use App\Http\Requests\RegisterRequest;
use App\Imports\ProductImport;
use App\Models\Comment;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Excel;
use Mail;


class ProductController extends Controller
{
    //Home
    public function home()
    {
        $product_count = Product::count();
        $user_count = User::count();
        $order_count = Order::count();
        $discount_count = Discount::count();
        $comment_count = Comment::count();


        $params = [
            'product_count' => $product_count,
            'user_count' => $user_count,
            'order_count' => $order_count,
            'discount_count' => $discount_count,
            'comment_count' => $comment_count,
        ];

        return view('admin.home', $params);
    }

    //Wedsite
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
        $comments = Comment::all();
        $users = User::all();
        $params = [
            'showProduct' => $showProduct,
            'comments' => $comments,
            'users' => $users,
        ];
        return view('frontend.website.detail', $params);
    }

    //Cart
    public function cart()
    {
        $discounts = Discount::all();
        $params = [
            'discounts' => $discounts,
        ];
        return view('frontend.website.cart',$params);
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);


        if (isset($cart[$id])) {
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

        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cập nhật giỏ hàng thành công!');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Xóa sản phẩm thành công!');
        }
    }

    public function remove_all_product()
    {
        $products = session('cart');
        foreach ($products as $product) {
            unset($products[$product['id']]);
            session()->put('cart', $products);
        }

        try {
            return redirect()->route('cart')->with('success', 'Xóa thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('cart')->with('error', 'Xóa không thành công');
        }
    }

    //Checkout
    public function checkout()
    {
        return view('frontend.website.checkout');
    }

    public function orders()
    {
        $sum_product = session('cart');
        $user =  Auth::user();
        foreach ($sum_product as $id_product) {
            $orders['user_id'] = $user->id;
            $orders['product_id'] = $id_product['id'];
            $orders['quantity'] = $id_product['quantity'];
            $orders['total'] = $id_product['price'] * $id_product['quantity'];
            $orders['status'] = '0';
            DB::table('orders')->insert($orders);
        }
        $products = session('cart');
        foreach ($products as $product) {
            unset($products[$product['id']]);
            session()->put('cart', $products);
        }
        try {
            $name = "Mai Chiếm An";
            Mail::send('mail.send_email', compact('name'), function($email) use($name){
                $email->subject('Demo test mail');
                $email->to('chieman2k3@gmail.com', $name);
            });
            session()->flash('success', 'Giao dịch thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Giao dịch không thành công!');
        }
    }

    //API list products
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

    //CRUD
    public function index(Request $request)
    {
        // $products = Product::select('*')->orderBy('id', 'desc')->paginate(10);
        $query = Product::select('*');
        if (isset($request->filter['productName']) && $request->filter['productName']) {
            $name = $request->filter['productName'];
            $query->where('productName', 'LIKE', '%' . $name . '%');
        }

        if ($request->s) {
            $query->where('productName', 'LIKE', '%' . $request->s . '%');
            $query->orwhere('id', $request->s);
        }

        $product_count  = Product::count();
        $query->orderBy('id', 'desc');
        $products = $query->paginate(10);
        $params = [
            'filter' => $request->filter,
            'products' => $products,
            'product_count' => $product_count,
        ];
        return view('admin.products.index', $params);
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(RegisterRequest $request)
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

    public function show(Product $product)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $params = [
            'product' => $product,
        ];
        return view('admin.products.edit', $params);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
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

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        try {
            return redirect()->route('products.index')->with('success', 'Xóa' . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', 'Xóa' . ' ' .  'không thành công');
        }
    }

    //Export and Import file Excel
    public function export()
    {
        return FacadesExcel::download(new ProductExport, 'product.xlsx');
    }

    public function import()
    {
        try {
            FacadesExcel::import(new ProductImport, request()->file('file'));
            return redirect()->route('products.index')->with('success', 'Thêm' . ' ' .  'thành công');;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Vui lòng chọn File');
        }
    }

    //Delete many
    public function delete_many(Request $request)
    {
        $validated = $request->validate(
            [
                'ids' => 'required',
            ],
            [
                'ids.required' => 'Bạn phải chọn ô',
            ],
        );

        try {
            $id = $request->ids;
            Product::whereIn('id', $id)->delete();
            return redirect()->route('products.index')->with('success', 'Xóa thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', 'Xóa không thành công');
        }
    }

    //List Order
    public function list_orders()
    {
        $list_orders = Order::select('*')->paginate(5);
        $users = User::all();
        $products = Product::all();
        $params = [
            'list_orders' => $list_orders,
            'users' => $users,
            'products' => $products,
        ];

        return view('frontend.website.list_orders', $params);
    }

    public function update_list_orders(Request $request)
    {
        if ($request->id) {
            $id = $request->id;
            $status = '1';
            Order::where('id', $id)->update(array(
                'status' => $status,
            ));
        }

        session()->flash('success', 'Kích hoạt thành công !');
    }
}
