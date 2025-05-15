@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Sản Phẩm</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Tạo Sản Phẩm</h4>

        </div>
        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Hình Ảnh</label>
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Chọn Tệp</label>
                        <input type="file" name="image" id="image-upload" />
                      </div>
                </div>

                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label>Danh Mục</label>
                    <select name="category" class="form-control select2" id="" >
                        <option value="">Chọn</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Giá</label>
                    <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                </div>

                <div class="form-group">
                    <label>Giá Khuyến Mãi</label>
                    <input type="text" name="offer_price" class="form-control" value="{{ old('offer_price') }}">
                </div>

                <div class="form-group">
                    <label>Số Lượng</label>
                    <input type="text" name="quantity" class="form-control" value="{{ old('quantity') }}">
                </div>

                <div class="form-group">
                    <label>Mô Tả Ngắn</label>
                    <textarea name="short_description" class="form-control" id="">{{ old('short_description') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Mô Tả Chi Tiết</label>
                    <textarea name="long_description" class="form-control summernote" id="">{{ old('long_description') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Mã SKU</label>
                    <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">
                </div>

                <div class="form-group">
                    <label>Tiêu Đề SEO</label>
                    <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title') }}">
                </div>

                <div class="form-group">
                    <label>Mô Tả SEO</label>
                    <textarea name="seo_description" class="form-control" id="">{{ old('seo_description') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Hiển Thị Trang Chủ</label>
                    <select name="show_at_home" class="form-control" id="">
                        <option value="1">Có</option>
                        <option selected value="0">Không</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Trạng Thái</label>
                    <select name="status" class="form-control" id="">
                        <option value="1">Hoạt Động</option>
                        <option value="0">Không Hoạt Động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Tạo</button>
            </form>
        </div>
    </div>
</section>
@endsection
