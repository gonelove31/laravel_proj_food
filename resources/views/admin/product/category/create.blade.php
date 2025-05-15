@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Danh Mục</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Tạo Danh Mục</h4>

        </div>
        <div class="card-body">
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="name" class="form-control">
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
