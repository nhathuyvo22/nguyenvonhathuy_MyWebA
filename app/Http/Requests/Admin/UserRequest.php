<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('user');
        return [
            'fullname' => 'required|string|min:3|max:100',
            'username' => [
                'required',
                'string',
                'min:3',
                'max:30',
                Rule::unique('users', 'username')->ignore($id, 'id'),
            ],
            'email' => [
                'required',
                'email',
                'max:50',
                Rule::unique('users', 'email')->ignore($id, 'id'),
            ],
            'status' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string'   => ':attribute phải là chuỗi ký tự.',
            'min'      => ':attribute phải từ :min ký tự trở lên.',
            'max'      => ':attribute không vượt quá :max ký tự.',
            'unique'   => ':attribute đã tồn tại.',
            'email'    => ':attribute không đúng định dạng email.',
            'status.in' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'fullname' => 'Họ tên',
            'username' => 'Tên đăng nhập',
            'email'    => 'Email',
            'status'   => 'Trạng thái',
        ];
    }
}
