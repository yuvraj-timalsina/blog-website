<?php

    namespace App\Http\Requests\Category;

    use Illuminate\Foundation\Http\FormRequest;

    class StoreCategoryRequest extends FormRequest
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
                'name' => 'required|unique:categories|max:255',
            ];
        }

        /**
         * Get the error messages for the defined validation rules.
         *
         * @return array
         */
        public function messages()
        {
            return [
                'name.required' => 'Oops! The field is empty...!!',
                'name.unique' => 'It\'s already taken. Try something different...!!',
            ];
        }
    }
