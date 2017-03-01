<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends AsdhController
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $categories = Category::all();
    $posts = Post::orderBy('created_at', 'desc')->paginate($this->default_pagination_limit);
    return view('admin.post.index', compact('posts', 'categories'));
  }

  public function create()
  {
    $categories = Category::all();
    $tag = new Tag();
    // get the names of all tags as array
    $tag_names = $tag->names_as_array();
    return view('admin.post.create', compact('categories', 'tag_names'));
  }

  // public function store(Request $request)
  public function store(PostRequest $request)
  {
    // dd($request->hi);
    $post = new Post;
    $post_message = ($request->active == "on") ? 1 : 0;

    $image_path_from_public = "post";
    // returns image name if uploaded successfully else false
    $image_name = "no-image.jpg";
    if ($request->image !== null) {
      $image_name = upload_image($request->image, $image_path_from_public);
      if (!$image_name) {
        return redirect()->to(route('post.create'))->with('failure_message', 'Sorry, something went wrong while uploading the image. Please try again later!');
      }
    }

    $post->title = $request->title;
    $post->slug = $request->slug;
    $post->content = $request->get('content');
    $post->image = $image_name;
    $post->active = $post_message;
    $post->category_id = $request->category;
    $post->user_id = Auth::user()->id;

    if ($post->save()) {
      $request_tags = explode(',', $request->tag);
      $database_tags = Tag::all();
      $post->tags()->attach($this->link_post_and_tags($request_tags, $database_tags));

      return redirect()->to(route('post.index'))->with('success_message', 'Successfully created');
    } else {
      return redirect()->to(route('post.index'))->with('failure_message', 'Sorry, this post could not be saved!');
    }
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $categories = Category::all();
    $post = Post::findOrFail($id);
    $tag = new Tag();
    $tag_names = $tag->names_as_array();
    return view('admin.post.edit', compact('post', 'categories', 'tag_names'));
  }

  public function update(PostRequest $request, $id)
  {
    $post = Post::findOrFail($id);

    $post_message = ($request->active == "on") ? 1 : 0;

    $image_path_from_public = "post";
    $image_name = $post->image;
    if ($request->image !== null) {
      if ($image_name != 'no-image.jpg') {
        File::delete('public/images/post/' . $image_name);
      }
      $image_name = upload_image($request->image, $image_path_from_public);
    }
    if (!$image_name) {
      return redirect()->to(route('post.create'))->with('failure_message', 'Sorry, something went wrong while uploading the image. Please try again later!');
    }

    $post->title = $request->title;
    $post->slug = $request->slug;
    $post->content = $request->get('content');
    $post->image = $image_name;
    $post->category_id = $request->category;
    $post->active = $post_message;

    $request_tags = explode(',', $request->tag);
    $database_tags = Tag::all();

    // unlink tags from the post that are not in the tag section of the post
    // I have kept it before save because if kept after save then $post->tags and $request_tags will always be same.
    // All the $request->tags will be $post->tags after save.
    $post->tags()->detach($this->deleted_tags_on_update($post->tags, $request_tags));

    if ($post->save()) {
      // add table and tag relation to intermediate table
      // here second parameter is false because by default it is true and will delete the relations of all the other tags and posts in the intermediate table
      $post->tags()->attach($this->link_post_and_tags($request_tags, $database_tags));

      return redirect()->to(route('post.index'))->with('success_message', 'Successfully updated');
    } else {
      return redirect()->to(route('post.index'))->with('failure_message', 'Sorry, your post could not be updated!');
    }
  }

  public function destroy($id)
  {
    $post = Post::findOrFail($id);
    if ($post->delete()) {
      if ($post->image !== "no-image.jpg") {
        File::delete('public/images/post/' . $post->image);
      }
      $post->tags()->detach();
      return "Successfully deleted";
    } else {
      return 'no';
    }
  }

  /*
   * link_post_and_tags()
   * This function will save new tags and return array of ids of the all the tags in the $request_tags array,
   * $request_tags are the tags that are submitted by the user during filling a form
   * $database_tags are all the tags from database
   * */
  private function link_post_and_tags($request_tags, $database_tags)
  {
    $flag = 0;
    $tag_ids = [];
    if (count($request_tags) == 1 && $request_tags[0] === "" || $request_tags[0] === null) {
      $request_tags = ['default'];
    }
    foreach ($request_tags as $request_tag) {
      foreach ($database_tags as $database_tag) {
        if (strtolower(trim($request_tag)) == $database_tag->name) {
          $tag_ids[] = $database_tag->id;
          $flag = 0;
          break;
        } else {
          $flag = 1;
        }
      }
      if ($flag == 1 && $request_tag != "" && !empty($request_tag) && $request_tag != null && $request_tag != " " || count($database_tags) == 0) {
        $tag = new Tag();
        $tag->name = strtolower(trim($request_tag));
        $tag->slug = str_replace(" ", "-", $tag->name);
        $tag->save();
        $tag_ids[] = $tag->id;
      }
    }
    return $tag_ids;
  }

  /*
   * Returns ids of the tags that are deleted on update
   * First parameter is the array of post tags (objects) and second parameter is the array of updated tags (names)
   * */
  private function deleted_tags_on_update($before_update_tags, $after_update_tags)
  {
    $flag = 0;
    $tag_ids = [];
    // $but =[];
    foreach ($before_update_tags as $before_update_tag) {
      foreach ($after_update_tags as $after_update_tag) {
        if (trim($before_update_tag->name) == trim($after_update_tag)) {
          $flag = 0;
          break;
        } else {
          $flag = 1;
        }
      }

      if ($flag == 1) {
        $tag_ids[] = $before_update_tag->id;
      }
    }
    return $tag_ids;
  }
}
