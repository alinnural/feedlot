<?php
namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Validators;

class ReCaptchataTestFormRequest extends FormRequest
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
        return [
            'g-recaptcha-response' => 'required|Recaptcha',
            'name' => 'required',
            'email' => 'required|email',
            'title' => 'required'
        ];
    }

    public function postFillData()
    {
        return [
            'title' => $this->title,
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description
        ];
    }
}
