<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'productname' => [
                'required',
                'string',
                'min:5',
                'max:150',
                Rule::unique('products', 'productname')->ignore($id, 'id'),
            ],
            'slug' => [
                'required',
                'string',
                'min:5',
                'max:200',
                'regex:/^[a-z0-9_-]+$/',
                Rule::unique('products', 'slug')->ignore($id, 'id'),
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:10000000',
            ],
            'pricediscount' => [
                'required',
                'numeric',
                'min:0',
                'lte:price',
            ],
            'status'  => 'required|in:0,1',
            'cateid' => 'required|exists:categories,cateid',
            'brandid' => 'nullable|exists:brands,id',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'imgs' => 'nullable|array',
            'imgs.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => [
                'nullable',
                'regex:/^[^@!$\^]*$/', // không chứa ký tự đặc biệt
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required'              => ':attribute không được để trống.',
            'string'                => ':attribute phải là chuỗi ký tự.',
            'min'                   => ':attribute phải từ :min ký tự trở lên.',
            'max'                   => ':attribute không vượt quá :max.',
            'unique'                => ':attribute đã tồn tại.',
            'numeric'               => ':attribute phải là số.',
            'slug.regex'            => ':attribute chỉ được chứa chữ thường, số, dấu _ và dấu -.',
            'status.in'             => ':attribute không hợp lệ.',
            'cateid.exists'         => ':attribute không tồn tại.',
            'brandid.exists'        => ':attribute không tồn tại.',
            'pricediscount.lte'     => ':attribute không được lớn hơn giá gốc.',
            'description.regex'     => ':attribute không được chứa ký tự đặc biệt (@, !, $, ^).',
            'img.image'             => 'Ảnh chính phải là file hình ảnh.',
            'img.mimes'             => 'Ảnh chính chỉ chấp nhận jpg, jpeg, png, webp.',
            'img.max'               => 'Ảnh chính tối đa 2MB.',
            'imgs.array'            => 'Ảnh phụ phải là một danh sách.',
            'imgs.*.image'          => 'Ảnh phụ phải là file hình ảnh.',
            'imgs.*.mimes'          => 'Ảnh phụ chỉ chấp nhận jpg, jpeg, png, webp.',
            'imgs.*.max'            => 'Ảnh phụ tối đa 2MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'productname'  => 'Tên sản phẩm',
            'slug'         => 'Đường dẫn (Slug)',
            'price'        => 'Giá',
            'pricediscount' => 'Giá khuyến mãi',
            'status'       => 'Trạng thái',
            'cateid'       => 'Loại sản phẩm',
            'brandid'      => 'Thương hiệu',
            'description'  => 'Mô tả',
            'img'          => 'Ảnh chính',
            'imgs'         => 'Ảnh phụ',
        ];
    }
}
