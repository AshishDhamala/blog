<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NavigationRequest extends FormRequest
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
    $navigation_id = $this->route('navigation');

    return [
        'name' => 'bail|required|string|max:255',
        'link' => [
            'required',
            'url',
            Rule::unique('navigations')->ignore($navigation_id)
        ],
    ];
  }
}
