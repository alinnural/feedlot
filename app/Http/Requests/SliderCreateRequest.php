<?php
namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Slider;

class SliderCreateRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize()
  {
     return Auth::check();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
        'name'     => 'required|regex:/^[A-Za-z ]+$/',
        'is_active' => 'required',
        'photo'     => 'required|image|mimes:jpeg,png|min:1'
    ];
  }

  /**
   * Return the fields and values to create a new post from
   */
  public function postFillData()
  {
    return [
        'name'     => $this->name,
        'is_active' => $this->is_active
    ];
  }
}