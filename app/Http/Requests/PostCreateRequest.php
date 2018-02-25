<?php
namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostCreateRequest extends FormRequest
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
      'title' => 'required|unique:posts,title',
      'subtitle' => 'required',
      'content' => 'required',
      'meta_description' => 'required',
      'page_image' => 'image|max:2048'
            // 'layout' => 'required',
        ];
    }

    /**
     * Return the fields and values to create a new post from
     */
    public function postFillData()
    {
        $published_at = new Carbon($this->publish_date . ' ' . $this->publish_time);
        return [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'page_image' => $this->page_image,
            'content_raw' => $this->get('content'),
            'meta_description' => $this->meta_description,
            'is_draft' => (bool) $this->is_draft,
      'published_at' => $published_at,
      'layout' => '',//$this->layout,
    ];
  }
}