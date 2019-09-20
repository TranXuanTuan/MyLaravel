<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function index(Request $request)
    {
        $data = [];
        $books = $this->book;
        $category_id = $request->category_id;
        if ($category_id) {
            $books = $books->where('category_id', $category_id);
        }
        $books = $books->paginate(5);
        $data['books'] = $books;
        $data['menu_active'] = 'book';
        return view('frontend.books.list', $data);
    }

    public function show($id)
    {
        $data = [];
        $book = $this->book->find($id);
        $data['book'] = $book;
        $data['menu_active'] = 'book';
        return view('frontend.books.detail', $data);
    }
}
