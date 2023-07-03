<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * To handle validation of employee registration
 *
 * @author Swam Htet Aung
 *
 * @create date 22-06-2023
 *
 */
class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @author Swam Htet Aung
     *
     * @create date 22-06-2023
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
     * @create date 22-06-2023
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => 'required|numeric',
            'employee_code' => ['required'],
            'employee_name' => ['required'],
            'nrc_number' => ['required','regex:/^[^!@#$%^&*_+=~`[\]{}|:;"<>,.?\\\]+$/'],
            'email_address' => 'required|email|unique:employees,email_address',
            'password' => 'required|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^A-Za-z0-9]).{4,8}$/',
            'date_of_birth' => 'required',
            'photo'=>'mimes:jpeg,jpg,png|max:10240'
        ];
    }

    /**
     * Customize the validation error messages
     * @author Swam Htet Aung
     *
     * @create date 30-06-2023
     * @return array
     */
    public function messages()
    {
        return [
            'photo.max'=>'The photo may not be greater than 10 MBs.'
        ];
    }
}
