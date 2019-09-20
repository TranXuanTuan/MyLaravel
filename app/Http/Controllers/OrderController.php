<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function index($book_id, Request $request)
    {
        $orders = [];
        if ($request->session()->has('orders') == true) {
            $orders = session('orders');
        }

        // check $id if exist then show error
        if (in_array($book_id, $orders))
            return redirect()->back()->with('error', 'This Book was exist in cart.');

        // OK then add data
        $orders[] =  $book_id;
        // update session
        session(['orders' => $orders]);

        return redirect()->back()->with('success', 'Add Book to Cart successful.');
    }

    public function cart(Request $request)
    {
        $data = [];
        $orders = [];
        if ($request->session()->has('orders') == true) {
            $orders = session('orders');
        }

        if (!empty($orders)) {
            $books = $this->book->whereIn('id', $orders)->get();
            $data['books'] = $books;
        }

        $data['menu_active'] = 'cart';
        return view('frontend.orders.cart', $data);
    }

    public function cancel(Request $request, $id)
    {
        $data = [];
        $orders = [];
        if ($request->session()->has('orders') == true) {
            $orders = session('orders');
        }

        if (!empty($orders)) {
            // delete $id in $orders
            $key = array_search ($id, $orders);
            unset($orders[$key]);

            // update session
            session(['orders' => $orders]);
            $books = $this->book->whereIn('id', $orders)->get();
            $data['books'] = $books;
        }

        $data['menu_active'] = 'cart';
        return redirect()->back()->with('success', 'Remove this order leave cart successful.');
    }

    public function complete(Request $request)
    {
        $data = [];
        $orders = [];
        if ($request->session()->has('orders') == true) {
            $orders = session('orders');
        }
        //todo code
    }
}
