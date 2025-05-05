<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Hiển thị form tạo đơn hàng mới.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.create');
    }

    /**
     * Lưu đơn hàng mới vào database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'address' => 'required|string',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
        ]);

        // Tạo đơn hàng mới
        Order::create($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Đơn hàng được tạo thành công!');
    }

    /**
     * Hiển thị thông tin chi tiết của đơn hàng.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Hiển thị form chỉnh sửa đơn hàng.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.edit', compact('order'));
    }

    /**
     * Cập nhật thông tin đơn hàng trong database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'address' => 'required|string',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
        ]);

        // Cập nhật đơn hàng
        $order = Order::findOrFail($id);
        $order->update($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Đơn hàng được cập nhật thành công!');
    }

    /**
     * Xóa đơn hàng khỏi database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Đơn hàng đã được xóa thành công!');
    }
} 