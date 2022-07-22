<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertPollRequest extends FormRequest
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

    public function messages()
    {
        return [
            'title.required' => 'Tytuł ankiety jest wymagany!',
            'title.max' => 'Tytuł ankiety jest za długi!',
            'slug.required' => 'Adres ankiety jest wymagany!',
            'slug.max' => 'Adres ankiety jest za długi!',
            'slug.unique' => 'Taki adres już istnieje!',
            'status' => 'Wystąpił błąd podczas publikacji ankiety.',
            'question.required' => 'Wymagane jest przynajmniej jedno pytanie!',
            'question.*.required' => 'Uzupełnij pytanie!',
            'question.*.max' => 'Pytanie może mieć max 100 znaków!',
            'type.*.in' => 'Niepoprawny typ pytania!',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'slug' => 'required|max:200|unique:polls',
            'status' => Rule::in(['on']),
            'question' => 'required|array|min:1',
            'question.*' => 'required|string|max:100',
            'type.*' => [
                'required',
                Rule::in(['radio', 'text']),
            ],
        ];
    }
}
