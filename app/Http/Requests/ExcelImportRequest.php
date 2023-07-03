<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * To handle validation of excel upload registration
 *
 * @author Swam Htet Aung
 *
 * @create date 21-06-2023
 *
 */
class ExcelImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @author Swam Htet Aung
     *
     * @create date 23-06-2023
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @author Swam Htet Aung
     *
     * @create date 23-06-2023
     * @return array
     */
    public function rules()
    {
        return [
            'excel' => 'required|file|mimes:xlsx'
        ];
    }
}
