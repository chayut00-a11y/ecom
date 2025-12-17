<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Session('user');
        $useraddress = Address::where('user_id', $user['id'])->get();
        $order = Order::where('user_id', session::get('user')->id)
            ->where('status', 0)
            ->with('order_details.product')
            ->first();
        // dd($useraddress);
        return view('orders.index')->with(['order' => $order, 'user' => $user ,'useraddress' => $useraddress]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        $order = Order::where('user_id', session::get('user')->id)->where('status', 0)->first();
        if ($order) {
            $orderDetail = $order->order_details()->where('product_id', $product->id)->first();

            if ($orderDetail) {
                $amountNew = $orderDetail->amount + 1;
                $orderDetail->update([
                    'amount' => $amountNew,
                ]);
            } else {
                $prepareCartDetail = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'amount' => 1,
                    'price' => $product->price,
                ];

                $orderDetail = OrderDetail::create($prepareCartDetail);
            }
        } else {
            $prepareCart = [
                'status' => 0,
                'user_id' => session::get('user')->id,
            ];
            // dd($prepareCart);

            $order = Order::create($prepareCart);
            $product = Product::find($request->product_id);
            $prepareCartDetail = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'amount' => 1,
                'price' => $product->price,
            ];

            $orderDetail = OrderDetail::create($prepareCartDetail);

        }
        $totalRaw = 0;
        $total = $order->order_details->map(function ($orderDetail) use ($totalRaw) {
            $totalRaw += $orderDetail->amount * $orderDetail->price;
            return $totalRaw;
        })->toarray();

        $order->update([
            'total' => (array_sum($total)),
        ]);
        // settimeout
        
       
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

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
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $orderDetail = $order->order_details()->where('product_id', $request->product_id)->first();
        $address_id = $request->address_id;
        if ($request->value == "checkout") {
            // dd($address_id);
            $order->update([
                'status' => 1,
                'address' => $address_id,
            ]);
        } else {
            if ($request->value == "increase") {
                $amountNew = $orderDetail->amount + 1;
            } elseif ($request->value == "decrease") {
                $amountNew = $orderDetail->amount - 1;
                if ($amountNew == 0) {
                    $orderDetail->delete();

                    if ($order->order_details->count() == 0) {
                        $order->delete();
                    }
                }
            }
            $orderDetail->update([
                'amount' => $amountNew,
            ]);

            $totalRaw = 0;
            $total = $order->order_details->map(function ($orderDetail) use ($totalRaw) {
                $totalRaw += $orderDetail->amount * $orderDetail->price;
                return $totalRaw;
            })->toarray();

            $order->update([
                'total' => (array_sum($total)),
            ]);

        }

        return redirect()->route('orders.index');
    }

    public function updateStatus(Request $request)
    {

        $order_id = $request->order_id;
        $order = Order::find($order_id);
        $order->status = $request->status;
        $order->update();

        return redirect('allorder')->with('success', 'Data Saved');
    }

    public function editStatus($id)
    {
        $orders = Order::find($id);

        return response()->json([
            'status' => 200,
            'orders' => $orders,
        ]);
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

    public function showorders()
    {
        $orders = Order::with('user', 'address_list')->paginate(5);

        return view('allorder', ['orders' => $orders]);

    }

    public function orderDetail($id)
    {
        $order = Order::with('user', 'address_list')->find($id);
        $order_details = $order->order_details()->with('product')->get();

        return view('orderdetail', ['order' => $order, 'order_details' => $order_details]);

    }

    public function adminorderDetail($id)
    {
        $order = Order::with('user', 'address_list')->find($id);
        $order_details = $order->order_details()->with('product')->get();

        return view('adminorderdetail', ['order' => $order, 'order_details' => $order_details]);

    }

    public function showuserOrder()
    {
        $user = Session('user');
        $orders = $user->orders()->with('user', 'address_list')->get();
        // dd($orders);
        $addresses = Address::where('user_id', $user['id'])->get();
        return view('orderlist', ['orders' => $orders, 'addresses' => $addresses ]);
    }
    
    public function uploadSlip(Request $request)
    {

        $order_id = $request->order_id;
        $order = Order::find($order_id);

        if ($image = $request->file('image')) {
            $destinationPath = 'images/slip/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
    
            $order->slip = $destinationPath.$profileImage;
            $order->save();
        }

        return redirect('/orderlist')->with('success', 'Data Saved');
    }
}
