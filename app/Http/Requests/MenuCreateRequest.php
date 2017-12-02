<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Page;

class MenuCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
            'name'=> 'required|unique:menus,name',
            //'url'=> 'required',
            'is_parent' => 'required',
            'have_child' => 'required',
            'active' => 'required',
            'position' => 'numeric',
            'type' => 'required',
        ];
    }

    public function postFillData()
    {
        if($this->type == 1)
        {
            $slug = '';//$this->getUniqueSlug($this->name);
            $url = $this->url;
            $page_id = 0;
        }
        else
        {
            $slug = Page::findOrFail($this->page_id)->slug;
            $url = 'page/' . $slug;
            $page_id = $this->page_id;
        }

        if($this->is_parent == 1)
        {
            $parent_id = 0;
        }
        else
        {
            $parent_id = $this->parent_id;
        }

        return [
            'name' => $this->name,
            'url' => $url,
            'is_parent' => $this->is_parent,
            'have_child' => $this->have_child,
            'parent_id' => $parent_id,
            'menu_admin' => 0,
            'active' => $this->active,
            'position' => $this->position,
            'page_id' => $page_id,
            'slug' => $slug,
            'type' => $this->type,
        ];
    }
}
