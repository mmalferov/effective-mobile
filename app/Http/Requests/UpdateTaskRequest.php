<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Enums\TaskStatus;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'sometimes',
                'required',
                'max:255',
            ],
            'description' => 'sometimes|nullable',
            'status' => [
                'sometimes',
                'string',
                Rule::enum(TaskStatus::class),
            ],
        ];
    }

    public function messages(): array
    {
         return [
            'title.required' => 'Title is required, non-empty',
            'title.max' => 'The title max length is 255 characters',
            'status.in' => 'Status must be one of: ' . TaskStatus::asString(),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'data' => null,
            'error' => [
                'code' => 422,
                'message' => $validator->errors()
            ],
        ], 422));
    }
}
