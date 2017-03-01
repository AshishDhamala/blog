<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends AsdhController
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $categories = Category::orderBy('name')->paginate($this->default_pagination_limit);
    return view('admin.category.index', compact('categories'));
  }

  public function create()
  {
    $categories = Category::all();
    return view('admin.category.create', compact('categories'));
  }

  public function store(CategoryRequest $request)
  {
    $category = new Category;

    $category->name = strtolower(trim($request->name));
    $category->slug = str_replace(" ", "-", $category->name);

    if ($category->save()) {
      return redirect()->to(route('category.index'))->with('success_message', 'Successfully created');
    } else {
      return redirect()->to(route('category.index'))->with('failure_message', '<b>' . $category->name . '</b> category could not be created');
    }
  }

  public function show($id)
  {
    $category = Category::findOrFail($id);
    $posts = $category->posts()->paginate($this->default_pagination_limit);
    return view('admin.category.show', compact('posts'));
  }

  public function edit($id)
  {
    $category = Category::findOrFail($id);
    $categories = Category::all();
    return view('admin.category.edit', compact('category', 'categories'));
  }

  public function update(CategoryRequest $request, $id)
  {
    $category = Category::findOrFail($id);

    if ($category->name === "default" || $category->name === "Default") {
      return redirect()->to(route('category.index'))->with('success_message', "Sorry \"{$category->name}\" category cannot be updated.");
    }

    $category->name = strtolower(trim($request->name));
    $category->slug = str_replace(" ", "-", $category->name);

    if ($category->save()) {
      return redirect()->to(route('category.index'))->with('success_message', 'Successfully updated');
    } else {
      return redirect()->to(route('category.index'))->with('failure_message', '<b>' . $category->name . '</b> category could not be updated');
    }
  }

  public function destroy($id)
  {
    $category = Category::find($id);
    $posts = $category->posts;
    $default_category = Category::where('slug', 'default')->first();

    // show message that default category cannot be deleted
    if ($category->name === "default" || $category->name === "Default") {
      return redirect()->to(route('category.index'))->with('success_message', "Sorry \"{$category->name}\" category cannot be deleted.");
    }

    if ($category->delete()) {
      // assign the id of the deleted category to default category.
      foreach ($posts as $post) {
        $post->category()->associate($default_category);
        $post->save();
      }
      return "Successfully deleted";
    } else {
      return 'no';
    }
  }

  /*public function ajax_test()
  {
    $id = $_POST['id'];
    $category = Category::find($id);
    return json_encode($category->name);
  }*/

}
