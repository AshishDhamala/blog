<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\Navigation;
use App\Post;
use Illuminate\Http\Request;

class AdminController extends AsdhController
{
  public function __construct(Company $company)
  {
    parent::__construct();

    $this->middleware('auth');
  }

  public function index()
  {
    $limit = 5;
    $this->website['company'] = Company::find(1);
    $this->website['categories'] = Category::limit($limit)->orderBy('name')->get();
    $this->website['posts'] = Post::limit($limit)->get();
    $this->website['public_navigations'] = Navigation::where('admin', 0)->limit($limit)->orderBy('name')->get();
    $this->website['navigations'] = Navigation::limit($limit)->orderBy('name')->get();
    return view('admin.index', $this->website);
  }
}
