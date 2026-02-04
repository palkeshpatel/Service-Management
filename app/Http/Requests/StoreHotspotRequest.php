<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotspotRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'city' => 'required|string|max:255',
            'delivery_date' => 'required|date|date_format:Y-m-d',
            'invoice_no' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255',
            'loading_video' => 'required|file|mimes:mp4,avi,mov,wmv|max:10240',
            'damage_photos' => 'required|array|min:2|max:10',
            'damage_photos.*' => 'required|image|mimes:jpeg,jpg,png|max:5120',
            'pallet_id_slip' => 'required|image|mimes:jpeg,jpg,png|max:5120',
            'installation_site' => 'required|image|mimes:jpeg,jpg,png|max:5120',
            'issue_photos' => 'required|array|min:2|max:10',
            'issue_photos.*' => 'required|image|mimes:jpeg,jpg,png|max:5120',
        ];
    }
}
