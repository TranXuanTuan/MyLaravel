<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
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
            'parent' => 'category',
            'child' => 'index'
        ];
        $data['sidebar'] = $sidebar;

        $categories = $this->category;

        // search with book name
        $search_category_name = null;
        if ($request->search_category_name) {
            $search_category_name = $request->search_category_name;
            $categories = $categories->where('name', 'like', '%' . $search_category_name . '%');
        }
        $data['search_category_name'] = $search_category_name;

        $categories = $categories
            ->orderBy('id', 'desc')
            ->paginate(5);
        $data['categories'] = $categories;

        return view('backend.categories.index', $data);
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
            'parent' => 'category',
            'child' => 'add'
        ];
        $data['sidebar'] = $sidebar;

        return view('backend.categories.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $params = $request->all();
        $this->category->name = $params['name'];

        $check = $this->category->save();
        if ($check) {
            // insert OK
            return redirect(route('admin-category-index'))->with('success', 'Insert category successful.');
        }

        // insert fail
        return redirect(route('admin-category-index'))->with('fail', 'Insert category fail.');
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
            'parent' => 'category',
            'child' => 'index'
        ];
        $data['sidebar'] = $sidebar;

        $category = $this->category->find($id);
        $data['category'] = $category;
        return view('backend.categories.detail', $data);
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
            'parent' => 'category',
            'child' => 'index'
        ];
        $data['sidebar'] = $sidebar;

        $category = $this->category->find($id);
        $data['category'] = $category;
        return view('backend.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $params = $request->all();
        $this->category = $this->category->find($id);
        $this->category->name = $params['name'];

        $check = $this->category->save();
        if ($check) {
            // insert OK
            return redirect(route('admin-category-index'))->with('success', 'Update category successful.');
        }

        // insert fail
        return redirect(route('admin-category-index'))->with('fail', 'Update category fail.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->find($id);
        if (!$category->books->isEmpty()) {
            return redirect(route('admin-category-index'))->with('error', 'Cannot delete catgory name: ' . $category->name);
        }

        $check = $category->delete();
        if ($check) {
            // insert OK
            return redirect(route('admin-category-index'))->with('success', 'Delete category successful.');
        }

        // insert fail
        return redirect(route('admin-category-index'))->with('fail', 'Delete category fail.');
    }
}
