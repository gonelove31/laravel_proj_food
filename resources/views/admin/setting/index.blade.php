@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Cài Đặt</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Tất Cả Cài Đặt</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-2">
                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#general-setting"
                                    role="tab" aria-controls="home" aria-selected="true">Cài Đặt Chung</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab4" data-toggle="tab" href="#logo-setting" role="tab"
                                    aria-controls="home" aria-selected="true">Cài Đặt Logo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab4" data-toggle="tab" href="#appearance-setting" role="tab"
                                    aria-controls="home" aria-selected="true">Cài Đặt Giao Diện</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#pusher-setting"
                                    role="tab" aria-controls="profile" aria-selected="false">Cài Đặt Pusher</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="" data-toggle="tab" href="#mail-setting" role="tab"
                                    aria-controls="contact" aria-selected="false">Cài Đặt Mail</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="" data-toggle="tab" href="#seo-setting" role="tab"
                                    aria-controls="contact" aria-selected="false">Cài Đặt SEO</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-10">
                        <div class="tab-content no-padding" id="myTab2Content">

                            @include('admin.setting.sections.general-setting')

                            @include('admin.setting.sections.logo-setting')

                            @include('admin.setting.sections.appearance-setting')

                            @include('admin.setting.sections.pusher-setting')

                            @include('admin.setting.sections.mail-setting')

                            @include('admin.setting.sections.seo-setting')


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
