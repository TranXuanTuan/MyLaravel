<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $data = [];
        $categories = $this->category->all();
        $data['categories'] = $categories;
        $data['menu_active'] = 'category';

        return view('frontend.categories.list', $data);
    }
}
