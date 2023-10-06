<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgendaRequest extends FormRequest
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
    public function rules()
    {
        return [
            'fecha_disponibilidad' => ['required'],
            'hora_inicio' => ['required','date_format:H:i'],
            'hora_fin' => ['required', 'date_format:H:i'],
            'empresa_id' => ['required', 'not_in:0'],
        ];
    }


    public function messages()                                      
    {
        return [
            'fecha_disponibilidad.required' => __('Debes seleccionar una fecha.'),
            'hora_inicio.required' => __('Selecciona una hora de inicio.'),
            'hora_fin.required' => __('Seleciona una hora final.'),
            'empresa_id.not_in' => __('El cliente es requerido.'),
        ];
    }
}
