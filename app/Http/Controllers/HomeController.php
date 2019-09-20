<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $category;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $sidebar = [
            'parent' => 'category',
            'child' => 'index'
        ];
        $data['sidebar'] = $sidebar;

        $categories = $this->category
            ->orderBy('id', 'desc')
            ->get();
        $data['categories'] = $categories;
        return view('frontend.home.home', $data);
    }
}
