<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::select('*')->orderBy('id', 'desc')->paginate(10);
        $products = Product::all();
        $users = User::all();
        // dd($products);
        $params = [
            'discounts' => $discounts,
            'products' => $products,
            'users' => $users,
        ];
        
        return view('admin.discounts.index',$params); 
    }


    public function result_discounts(Request $request)
    {
        $requestData = $request->all();

        $user =  Auth::user();
        $discounts = Discount::all();
        $discountName = $requestData['getData'];
        $cart = session()->get('cart');
        try {
            foreach($discounts as $discount){
                if($discountName == $discount['discountName'] && isset($cart[$discount['product_id']]['id']) && $cart[$discount['product_id']]['id'] == $discount['product_id'] && $discount['user_id'] == $user['id']){
                    $totals = $cart[$discount['product_id']]['price'] - $discount['price'];
                    $cart[$discount['product_id']]["price"] = $totals;
                    session()->put('cart', $cart);
                    // $discount = Discount::find($discount['id']);
                    // $discount->delete();
                    $id = $discount['id'];
                    $discount = Discount::findOrFail($id);
                    $data_discount = session()->get('data_discount', []);
                        $data_discount[$id] = [
                            "id" => $id,
                            "discountName" => "discountName",
                            "product_id" => $discount['product_id'],
                            "user_id" => $discount['user_id'],
                        ];
                    session()->put('data_discount', $data_discount);
                    session()->flash('success', 'Áp dụng mã thành công!');
                    return false;
                }
                
            }
            if($discountName != $discount['discountName']){
                session()->flash('error', 'Áp dụng mã không thành công1!');
            }
            if($discountName == $discount['discountName'] && $discount['user_id'] != $user['id']){
                session()->flash('error', 'Áp dụng mã không thành công2!');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Áp dụng mã không thành công3!');

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $discounts = Discount::all();
        $products = Product::all();
        $users = User::all();
        // dd($products);
        $params = [
            'discounts' => $discounts,
            'products' => $products,
            'users' => $users,
        ];
        return view('admin.discounts.create',$params); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $discount = new Discount();
        $discount->discountName = $request->discountName;
        $discount->price = $request->price;
        $discount->product_id = $request->product_id;
        $discount->user_id = $request->user_id;
        try {
            $discount->save();
            return redirect()->route('discounts.index')->with('success', 'Thêm mã giảm giá thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('discounts.index')->with('error', 'Thêm mã giảm giá không thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
