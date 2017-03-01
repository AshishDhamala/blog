<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends AsdhController
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $tags = Tag::orderBy('name')->paginate($this->default_pagination_limit * 2);
    return view('admin.tag.index', compact('tags'));
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    //
  }

  public function show($id)
  {
    $mainTag = Tag::findOrFail($id);
    $posts = $mainTag->posts()->paginate($this->default_pagination_limit);
    return view('admin.tag.show', compact('mainTag', 'posts'));
  }

  public function edit($id)
  {
    $tag = Tag::findOrFail($id);
    return view('admin.tag.edit', compact('tag'));
  }

  public function update(TagRequest $request, $id)
  {
    $tag = Tag::findOrFail($id);
    $tag->name = $request->name;
    $tag->slug = str_replace(" ", "-", $tag->name);
    if ($tag->save()) {
      return redirect()->route('tag.index')->with('success_message', 'Successfully updated');
    } else {
      return redirect()->route('tag.index')->with('failure_message', 'Sorry, the tag could not be updated!');
    }
  }

  public function destroy($id)
  {
    $tag = Tag::findOrFail($id);
    if ($tag->delete()) {
      $tag->posts()->detach();
      return "Successfully deleted";
    } else {
      return 'no';
    }
  }
}
