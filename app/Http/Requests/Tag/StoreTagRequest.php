<?php

    namespace App\Http\Requests\Tag;

    use Illuminate\Foundation\Http\FormRequest;

    class StoreTagRequest extends FormRequest
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
                'name' => 'required|unique:tags|max:255',
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
