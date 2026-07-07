<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('post');
        return [
            'title' => [
                'required',
                'string',
                'min:5',
                'max:200',
                Rule::unique('posts', 'title')->ignore($id, 'id'),
            ],
            'slug' => [
                'required',
                'string',
                'min:5',
                'max:255',
                'regex:/^[a-z0-9_-]+$/',
                Rule::unique('posts', 'slug')->ignore($id, 'id'),
            ],
            'content'  => 'required|min:10',
            'status'   => 'required|in:0,1',
            'user_id'  => 'required|exists:users,id',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'required'       => ':attribute không được để trống.',
            'string'         => ':attribute phải là chuỗi ký tự.',
            'min'            => ':attribute phải từ :min ký tự trở lên.',
            'max'            => ':attribute không vượt quá :max ký tự.',
            'unique'         => ':attribute đã tồn tại.',
            'slug.regex'     => ':attribute chỉ được chứa chữ thường, số, dấu _ và dấu -.',
            'status.in'      => ':attribute không hợp lệ.',
            'user_id.exists' => ':attribute không tồn tại.',
            'image.image'    => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes'    => 'Chỉ chấp nhận ảnh jpg, jpeg, png, webp.',
            'image.max'      => 'Kích thước ảnh tối đa là 2MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'   => 'Tiêu đề',
            'slug'    => 'Đường dẫn (Slug)',
            'content' => 'Nội dung',
            'status'  => 'Trạng thái',
            'user_id' => 'Người đăng',
            'image'   => 'Hình ảnh',
        ];
    }
}
