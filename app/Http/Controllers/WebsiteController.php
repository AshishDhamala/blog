<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;
use App\Navigation;

class WebsiteController extends AsdhController
{
  public function __construct()
  {
    parent::__construct();
    $this->website['company'] = Company::find(1);
    $this->website['recent_posts'] = Post::where('active', 1)->orderBy('created_at','desc')->limit(5)->get();
    $this->website['popular_posts'] = Post::where('active', 1)->orderBy('view_count','desc')->limit(5)->get();
  }

  public function index()
  {
    $this->website['posts'] = Post::where('active', 1)->orderBy('created_at','desc')->limit(5)->get();
    return view('index', $this->website);
  }

  public function categories()
  {
    $categories = Category::all();
  }

  public function tags()
  {
    $tags = Tag::all();
  }

  /*public function posts()
  {
    $posts = Post::where('active', '1')->orderBy('created_at','desc')->paginate($this->default_pagination_limit);
    return view('posts', compact('posts'));
  }*/

  public function post_detail($slug)
  {
    $this->website['post'] = Post::where('slug', $slug)->first();
    // increments view_count column by 1
    $this->website['post']->increment('view_count');
    return view('post_detail', $this->website);
  }

  public function category_detail($slug)
  {
    $this->website['category'] = Category::where('slug', $slug)->first();
    return view('category_detail', $this->website);
  }

  public function tag_detail($slug)
  {
    $this->website['tag'] = Tag::where('slug',$slug)->first();
    return view('tag_detail', $this->website);
  }

  public function test_form()
  {
    $this->website['test'] = ['test'];
    return view('test', $this->website);
  }

  public function test(Request $request)
  {
    dd($request->multipleDelete);
  }

}