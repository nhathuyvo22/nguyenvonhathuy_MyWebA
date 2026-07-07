@extends('admin.layouts.admin')
@section('title', 'Sửa sản phẩm')
@section('content')
<div class="border rounded bg-white p-4 shadow-sm">
    <h3 class="mb-4">Sửa sản phẩm</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            {{-- CỘT BÊN TRÁI --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="productname" id="productname" class="form-control"
                        value="{{ old('productname', $product->productname) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control"
                        value="{{ old('slug', $product->slug) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Loại sản phẩm</label>
                    <select name="cateid" class="form-select">
                        <option value="">-- Chọn loại sản phẩm --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->cateid }}"
                            {{ old('cateid', $product->cateid) == $category->cateid ? 'selected' : '' }}>
                            {{ $category->catename }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Thương hiệu</label>
                    <select name="brandid" class="form-select">
                        <option value="">-- Chọn thương hiệu --</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ old('brandid', $product->brandid) == $brand->id ? 'selected' : '' }}>
                            {{ $brand->brandname }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Hình ảnh chính --}}
                <div class="mb-3">
                    <label class="form-label">Hình ảnh chính</label>
                    <input type="file" name="img" id="main-img-input" class="form-control">
                    <div class="mt-2">
                        {{-- Hiển thị ảnh cũ hoặc ảnh mới chọn bằng JS --}}
                        <img id="main-img-preview" src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('images/no-image.png') }}" class="img-thumbnail" width="120">
                    </div>
                </div>

                {{-- Chọn hình ảnh phụ mới --}}
                <div class="mb-3">
                    <label class="form-label">Thêm hình ảnh phụ</label>
                    <input type="file" name="imgs[]" id="imgs" class="form-control" multiple accept="image/*">
                    {{-- Khhu vực hiển thị ảnh phụ sắp upload --}}
                    <div id="preview-images" class="row mt-3"></div>
                </div>

                {{-- Danh sách ảnh phụ đã có trong DB --}}
                @if($product->images && $product->images->count())
                <div class="mb-3">
                    <label class="form-label text-warning fw-bold">Danh sách ảnh phụ hiện tại</label>
                    <div class="row">
                        @foreach($product->images as $image)
                        <div class="col-md-3 text-center mb-3" id="prod-img-{{ $image->id }}">
                            <img src="{{ asset('storage/products/' . $image->image) }}"
                                class="img-thumbnail"
                                style="width:120px;height:120px;object-fit:cover;">
                            <button type="button"
                                class="btn btn-danger btn-sm mt-2 btn-delete-image"
                                data-id="{{ $image->id }}"
                                data-url="{{ route('admin.products.images.destroy', $image->id) }}">
                                Xóa ảnh
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- CỘT BÊN PHẢI --}}
            <div class="col-md-6">
                {{-- CỘT BÊN PHẢI --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Giá</label>
                        <input type="number" name="price" class="form-control"
                            value="{{ old('price', $product->price) }}" required>
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá khuyến mãi</label>
                        <input type="number" name="pricediscount" class="form-control"
                            value="{{ old('pricediscount', $product->pricediscount) }}">
                        @error('pricediscount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">Trạng thái</label>
                        <input type="radio" class="btn-check" name="status" id="active" value="1"
                            {{ old('status', $product->status) == 1 ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="active">Hiển thị</label>

                        <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                            {{ old('status', $product->status) == 0 ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="inactive">Ẩn</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả sản phẩm</label>
                        <textarea name="description" rows="8" class="form-control">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Tự động tạo Slug khi nhập tên sản phẩm (Tính năng thêm giúp bạn tiện hơn)
        const nameInput = document.getElementById('productname');
        const slugInput = document.getElementById('slug');
        if (nameInput && slugInput) {
            nameInput.addEventListener('keyup', function() {
                let title = nameInput.value;
                let slug = title.toLowerCase();
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                slug = slug.replace(/ /gi, "-");
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                slugInput.value = slug;
            });
        }

        // 2. Preview Ảnh Chính khi chọn file
        const mainImgInput = document.getElementById('main-img-input');
        const mainImgPreview = document.getElementById('main-img-preview');
        if (mainImgInput && mainImgPreview) {
            mainImgInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        mainImgPreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }


        const imgsInput = document.getElementById('imgs');
        const previewContainer = document.getElementById('preview-images');

        if (imgsInput && previewContainer) {
            imgsInput.addEventListener('change', function() {
                previewContainer.innerHTML = '';
                const files = this.files;

                if (files) {
                    [...files].forEach(file => {
                        if (!file.type.match('image.*')) return;

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const div = document.createElement('div');
                            div.className = 'col-md-2 text-center mb-2';
                            div.innerHTML = `
                            <img src="${e.target.result}" class="img-thumbnail" style="width:100px; height:100px; object-fit:cover;">
                            <small class="text-muted d-block text-truncate">${file.name}</small>
                        `;
                            previewContainer.appendChild(div);
                        }
                        reader.readAsDataURL(file);
                    });
                }
            });
        }

        const baseUrl = "{{ url('admin/products/images') }}";
        const csrf = '{{ csrf_token() }}';

        document.body.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-delete-image');
            if (!btn) return;

            e.preventDefault();
            if (!confirm('Bạn có chắc muốn xóa ảnh này vĩnh viễn không?')) return;

            const id = btn.getAttribute('data-id');
            const url = btn.getAttribute('data-url') || (baseUrl + '/' + id);

            fetch(url, {
                    method: 'DELETE',
                    credentials: 'same-origin',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const el = document.getElementById('prod-img-' + id);
                        if (el) el.remove();
                    } else {
                        alert(data.message || 'Xóa không thành công');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Có lỗi xảy ra khi kết nối tới máy chủ.');
                });
        });
    });
</script>
@endsection