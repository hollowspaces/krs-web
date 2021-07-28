<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KelasRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $id = isset($this->kela) ? $this->kela : '';

        return [
            'kelas' => 'unique:kelas,kelas,'.$id
        ];
    }

    public function messages() {
        return [
            'kelas.unique' => 'Kelas sudah ada'
        ];
    }
}
