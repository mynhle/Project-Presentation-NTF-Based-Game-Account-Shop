<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        $accounts = Account::all();
        return view('admin.orders.create', compact('users', 'accounts'));
    }


    // Thêm đơn hàng mới
    public function store(Request $request)
    {
        // dd($request->all());
        Order::create($request->all());

        return redirect()->route('admin.orders.index')->with('success','Tạo đơn hàng thành công!');
    }

    public function edit ($id) {

        $users = User::all();
        $accounts = Account::all();
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order', 'users', 'accounts'));
    }

    // Sửa thông tin đơn hàng
    public function update(Request $request, $id)
    {

        $order = Order::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('admin.orders.index')->with('success','Sửa đơn hàng thành công!');
    }

    // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success','Xóa đơn hàng thành công!');
    }
}
