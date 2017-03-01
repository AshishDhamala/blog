<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
    $company_id = $this->route('company');

    return [
        'name' => 'bail|required|string|max:255',
        'email' => 'email',
        'established_date' => 'date',
        'address' => 'bail|string|max:255',
        'phone' => 'bail|string|max:255'
    ];
  }
}
