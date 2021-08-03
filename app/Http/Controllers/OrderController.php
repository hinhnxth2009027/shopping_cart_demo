<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        if (!Session::has('shoppingCart') || sizeof(Session::get('shoppingCart')) < 1) {
            return redirect()->route('show_all_product')->with('err_order', 'Hiện tại bạn chưa có sản phẩm nào');
        }
        $shopping_cart = Session::get('shoppingCart');
        //gọi hàm tạo order
        $order = $this->create_order($request);
        $order_details = [];
        $msg_err = '';
        foreach ($shopping_cart as $item){
            $product = Product::find($item->id);
            if ($product == null){
                $msg_err = 'Đã có lỗi xảy ra sản phẩm : '.$item->product_name.' với id : '.$item->id.' Không tồn tại hoặc đã bị xóa khỏi kho';
                break;
            }
            $order_detail = new OrderDetail();
            $order_detail->product_id = $product->id;
            $order_detail->unit_price = $product->price;
            $order_detail->quantity = $item->quantity;
            $order->total_price += $order_detail->quantity * $order_detail->unit_price;
            array_push($order_details,$order_detail);
        }
        if (sizeof($order_details) < 1){
            return back()->with('err_order',$msg_err);
        }
        try {
            DB::beginTransaction();
            $order->save();
            foreach ($order_details as $order_detail){
                $order_detail->order_id = $order->id;
                $order_detail->save();
            }
            Session::forget('shoppingCart');
            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
            return back()->with('err_order','Lưu đơn hàng thất bại');
        }
        return redirect()->route('show_all_product')->with('success_order','Bạn đã tạo order thành công');
    }

    public function index(){
        $orders = Order::query()->orderBy('id','DESC')->get();
        if (!Session::has('shoppingCart')){
            Session::put('shoppingCart',[]);
        }
        return view('client.order',[
            'orders'=>$orders,
            'product_count' => sizeof(Session::get('shoppingCart')),
        ]);
    }




    public function create_order($data){
        $order = new Order();
        $order->total_price = 0;
        $order->customer_id = 0;
        $order->ship_name = $data->ship_name;
        $order->ship_phone = $data->ship_phone;
        $order->ship_email = $data->ship_email;
        $order->ship_address = $data->ship_address;
        $order->note = $data->note;
        $order->is_checkout = false;
        $order->created_at = Carbon::now();
        $order->updated_at = Carbon::now();
        $order->status = 0;
        return $order;
    }

}
