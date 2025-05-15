@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Danh Mục Bài Viết</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Tất Cả Danh Mục Bài Viết</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.blog-category.create') }}" class="btn btn-primary">
                        Tạo Mới
                    </a>
                </div>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
