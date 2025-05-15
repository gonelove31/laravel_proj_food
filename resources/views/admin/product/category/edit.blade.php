@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Danh Mục</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Cập Nhật Danh Mục</h4>

        </div>
        <div class="card-body">
            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                </div>

                <div class="form-group">
                    <label>Hiển Thị Trang Chủ</label>
                    <select name="show_at_home" class="form-control" id="">
                        <option @selected($category->show_at_home === 1) value="1">Có</option>
                        <option @selected($category->show_at_home === 0) value="0">Không</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Trạng Thái</label>
                    <select name="status" class="form-control" id="">
                        <option @selected($category->status === 1) value="1">Hoạt Động</option>
                        <option @selected($category->status === 0) value="0">Không Hoạt Động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cập Nhật</button>
            </form>
        </div>
    </div>
</section>
@endsection
