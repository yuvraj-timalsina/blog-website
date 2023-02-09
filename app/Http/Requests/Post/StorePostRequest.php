<?php

    namespace App\Http\Requests\Post;

    use Illuminate\Foundation\Http\FormRequest;

    class StorePostRequest extends FormRequest
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
         * @return array<string, mixed>
         */
        public function rules()
        {
            return [
                'title' => 'required|unique:posts,title',
                'content' => 'required',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'category_id' => 'required|exists:categories,id',
                'tags' => 'required|array',
                'tags.*' => 'max:255',
            ];
        }
    }
