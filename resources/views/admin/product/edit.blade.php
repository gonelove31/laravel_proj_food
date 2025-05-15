@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Sản Phẩm</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Cập Nhật Sản Phẩm</h4>

        </div>
        <div class="card-body">
            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Hình Ảnh</label>
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Chọn Tệp</label>
                        <input type="file" name="image" id="image-upload" />
                      </div>
                </div>

                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                </div>

                <div class="form-group">
                    <label>Danh Mục</label>
                    <select name="category" class="form-control select2" id="" >
                        <option value="">Chọn</option>
                        @foreach ($categories as $category)
                            <option @selected($product->category_id === $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Giá</label>
                    <input type="text" name="price" class="form-control" value="{{ $product->price }}">
                </div>

                <div class="form-group">
                    <label>Giá Khuyến Mãi</label>
                    <input type="text" name="offer_price" class="form-control" value="{{ $product->offer_price }}">
                </div>

                <div class="form-group">
                    <label>Số Lượng</label>
                    <input type="text" name="quantity" class="form-control" value="{{ $product->quantity }}">
                </div>

                <div class="form-group">
                    <label>Mô Tả Ngắn</label>
                    <textarea name="short_description" class="form-control" id="">{!! $product->short_description !!}</textarea>
                </div>

                <div class="form-group">
                    <label>Mô Tả Chi Tiết</label>
                    <textarea name="long_description" class="form-control summernote" id="">{!! $product->long_description !!}</textarea>
                </div>

                <div class="form-group">
                    <label>Mã SKU</label>
                    <input type="text" name="sku" class="form-control" value="{{ $product->sku }}">
                </div>

                <div class="form-group">
                    <label>Tiêu Đề SEO</label>
                    <input type="text" name="seo_title" class="form-control" value="{{ $product->seo_title }}">
                </div>

                <div class="form-group">
                    <label>Mô Tả SEO</label>
                    <textarea name="seo_description" class="form-control" id="">{!! $product->seo_description !!}</textarea>
                </div>

                <div class="form-group">
                    <label>Hiển Thị Trang Chủ</label>
                    <select name="show_at_home" class="form-control" id="">
                        <option @selected($product->show_at_home === 1) value="1">Có</option>
                        <option @selected($product->show_at_home === 0) value="0">Không</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Trạng Thái</label>
                    <select name="status" class="form-control" id="">
                        <option @selected($product->status === 1) value="1">Hoạt Động</option>
                        <option @selected($product->status === 0) value="0">Không Hoạt Động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cập Nhật</button>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.image-preview').css({
                'background-image': 'url({{ asset($product->thumb_image) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
