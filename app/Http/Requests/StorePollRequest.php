<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\DataTransferObject\PollData;
use App\Rules\ContentFilter;

class StorePollRequest extends FormRequest
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
    public function rules(ContentFilter $contentFilter)
    {
        return [
            'title' => ['required', 'string', 'between:3,255', $contentFilter],
            'options.*' => ['required', 'string', 'between:1,255', $contentFilter],
            'settings.*.name' => ['required_with:settings.*.value', 'string', 'min:1'],
            'settings.*.value' => ['required_with:settings.*.name', 'min:1']
        ];
    }

    public function getDto()
    {
        return new PollData([
            'title' => $this['title'],
            'options' => $this['options'],
            'settings' => $this['settings']
        ]);
    }
}