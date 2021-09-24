<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $post = $this->route()->parameter('post');
        
        $rules = [
            'name' => ['required'],
            'slug' => ['required', 'unique:posts'],
            'status' => ['required', 'in:1,2'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'file' => ['image', 'nullable']
        ];

        if ($post) {
            $rules['slug'] = ['required', 'unique:posts,slug,'. $post->id];
        }

        if ($this->status == 2) {
            $rules = array_merge($rules, [
                'tags' => ['required'],
                'extract' => ['required'],
                'body' => ['required'],
            ]);
        }
        
        
        return $rules;
    }
}
