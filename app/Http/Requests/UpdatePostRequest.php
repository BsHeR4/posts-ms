<?php

namespace App\Http\Requests;

use App\Actions\PreparePostInput;
use App\Rules\MaxKeywords;
use App\Rules\PublishDateRule;
use App\Rules\SlugFormatRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255',],
            'slug' => ['nullable', 'string', 'max:255', new SlugFormatRule(), Rule::unique('posts', 'slug')->ignore($this->route('post'), 'slug')],
            'body' => 'sometimes|string',
            'meta_description' => 'sometimes|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:20',
            'keywords' => ['nullable', 'array', new MaxKeywords(6)],
            'keywords.*' => 'string|max:30',
        ];
    }

    public function messages()
    {
        return [
            'max' => 'the :attribute is too long!',
            'unique' => ':attribute already used please try another one',
            'array' => ':attribute should contain a list of values',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'post title',
            'body' => 'post body',
            'meta_description' => 'meta description',
            'slug' => 'slug',
            'tags' => 'tags',
            'keywords' => 'keywords',
        ];
    }

    /**
     * this method prepare the values of `slug` and `is_published` fields
     * using the PreparePostInput action
     */
    protected function prepareForValidation()
    {
        $this->merge(array_merge(
            PreparePostInput::prepareSlug(
                $this->only([
                    'title',
                    'slug'
                ])
            ),
            
        ));
    }

    /**
     * if the validation failed it return a json response
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Failed Validate Data',
            'errors' => $validator->errors(),
        ], 422));
    }
}
