<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommunityLinkForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'link' => 'required|url|max:255', //|unique:community_links
            'channel_id' => 'required|exists:channels,id',
            ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'link.required' => 'El enlace es obligatorio.',
            // 'link.unique' => 'Este enlace ya ha sido enviado.',
            'link.url' => 'El formato del enlace no es válido.',
            'channel_id.required' => 'Debes elegir un canal.',
            'channel_id.exists' => 'El canal seleccionado no es válido.',
        ];
    }

}
