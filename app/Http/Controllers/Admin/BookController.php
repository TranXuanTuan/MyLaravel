<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\BookCreateRequest;
use App\Http\Requests\Admin\BookUpdateRequest;
use App\Book;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    protected $book;
    protected $category;

    public function __construct(Book $book, Category $category)
    {
        $this->book = $book;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $sidebar = [
            'parent' => 'book',
            'child' => 'index'
        ];
        $data['sidebar'] = $sidebar;

        $books = $this->book;

        // search with book name
        $search_book_name = null;
        if ($request->search_book_name) {
            $search_book_name = $request->search_book_name;
            $books = $books->where('name', 'like', '%' . $search_book_name . '%');
        }
        $data['search_book_name'] = $search_book_name;

        // search with category_id
        $category_id = null;
        if ($request->category_id) {
            $category_id = $request->category_id;
            $books = $books->where('category_id', $category_id);
        }
        $data['category_id'] = $category_id;

        $books = $books
            ->orderBy('id', 'desc')
            ->paginate(5);
        $data['books'] = $books;

        // get data of categories table
        $categories = $this->category->pluck('name', 'id')->toArray();
        $data['categories'] = $categories;

        return view('backend.books.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $sidebar = [
            'parent' => 'book',
            'child' => 'add'
        ];
        $data['sidebar'] = $sidebar;

        $categories = $this->category->pluck('name', 'id')->toArray();
        $data['categories'] = $categories;

        return view('backend.books.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookCreateRequest $request)
    {
        // check picture ?
        if ($request->hasFile('picture')) {
            $ext = $request->file('picture')->getClientOriginalExtension();
            $this->book->picture = $request->file('picture')->storeAs(
                'public/book_images', time() . '.' . $ext
            );
        }

        $params = $request->all();
        $this->book->name = $params['name'];
        $this->book->publisher = $params['publisher'];
        $this->book->author = $params['author'];
        $this->book->category_id = $params['category_id'];
        $this->book->num_of_page = $params['num_of_page'];
        $this->book->maxdate = $params['maxdate'];
        $this->book->num = $params['num'];
        $this->book->summary = $params['summary'];

        $check = $this->book->save();
        if ($check) {
            // insert OK
            return redirect(route('admin-book-index'))->with('success', 'Insert Book successful.');
        }

        // insert fail
        return redirect(route('admin-book-index'))->with('fail', 'Insert Book fail.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $sidebar = [
            'parent' => 'book',
            'child' => 'index'
        ];
        $data['sidebar'] = $sidebar;

        $book = $this->book->find($id);
        $data['book'] = $book;
        return view('backend.books.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $sidebar = [
            'parent' => 'book',
            'child' => 'index'
        ];
        $data['sidebar'] = $sidebar;

        $categories = $this->category->pluck('name', 'id')->toArray();
        $data['categories'] = $categories;

        $book = $this->book->find($id);
        $data['book'] = $book;
        return view('backend.books.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, $id)
    {
        $params = $request->all();
        $this->book = $this->book->find($id);
        $this->book->name = $params['name'];
        $this->book->publisher = $params['publisher'];
        $this->book->author = $params['author'];
        $this->book->category_id = $params['category_id'];
        $this->book->num_of_page = $params['num_of_page'];
        $this->book->maxdate = $params['maxdate'];
        $this->book->num = $params['num'];
        $this->book->summary = $params['summary'];

        // check picture ?
        if ($request->hasFile('picture')) {
            $ext = $request->file('picture')->getClientOriginalExtension();
            $this->book->picture = $request->file('picture')->storeAs(
                'public/book_images', time() . '.' . $ext
            );
        }

        $check = $this->book->save();
        if ($check) {
            // update OK
            return redirect(route('admin-book-index'))->with('success', 'Update Book successful.');
        }

        // update fail
        return redirect(route('admin-book-index'))->with('fail', 'Update Book fail.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = $this->book->find($id)->delete();
        if ($check) {
            // delete OK
            return redirect(route('admin-book-index'))->with('success', 'Delete Book successful.');
        }

        // delete fail
        return redirect(route('admin-book-index'))->with('fail', 'Delete Book fail.');
    }
}
