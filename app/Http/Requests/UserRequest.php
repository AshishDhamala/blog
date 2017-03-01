<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $user_id = $this->route('user');

    return [
        'name' => 'bail|required|string|max:255',
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('users')->ignore($user_id)
        ],
        'password' => 'bail|string|nullable|same:password_confirmation',
        'password_confirmation' => 'bail|string|nullable',
        'twitter_username' => 'bail|string|nullable',
        'facebook_profile_url' => 'bail|nullable|url',
        'facebook_page_url' => 'bail|nullable|url',
    ];
  }
}
