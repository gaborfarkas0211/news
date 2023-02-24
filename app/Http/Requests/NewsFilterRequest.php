<?php

namespace App\Http\Requests;

use App\Rules\MaxArrayCount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsFilterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        $filters = config('newsdata.filters');

        $rules = [];
        foreach ($filters as $key => $options) {
            $rules[$key] = [
                'nullable',
                'array',
                Rule::in($options),
                new MaxArrayCount(config('services.newsdata.max_filter_count'))
            ];
            $rules["$key.*"] = ['distinct'];
        }

        return $rules;
    }
}
