<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    /*$post = Post::find($this->route('post'));
    if ($post && $this->user()->can('update', $post)) {
      return true;
    }
    if ($this->user()->can('create', Post::class)) {
      return true;
    }*/
    return true;
  }

  /**
   * This method will be invoked if authorize() fails
   */
  public function forbiddenResponse()
  {
    return redirect(route('post.index'))->with('failure_message', 'Sorry, you are not allowed to edit this post.');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $post_id = $this->route('post');

    return [
        'title' => [
            'required',
            'string',
            'max:255',
            Rule::unique('posts')->ignore($post_id)
        ],
        'slug' => [
            'required',
            'string',
            'max:255',
            Rule::unique('posts')->ignore($post_id)
        ],
        'content' => 'required',
        'image' => 'bail|image|mimes:jpeg,png,jpg,gif,svg,JPG',
        'category' => 'bail|required|integer',
        'tag' => 'bail|nullable',
    ];
  }
}
