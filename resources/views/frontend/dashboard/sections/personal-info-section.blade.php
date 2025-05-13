<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
aria-labelledby="v-pills-home-tab">
<div class="fp_dashboard_body">
    <h3>Chào mừng đến với trang cá nhân của bạn</h3>

    <div class="fp__dsahboard_overview">
        <div class="row">
            <div class="col-xl-4 col-sm-6 col-md-4">
                <div class="fp__dsahboard_overview_item">
                    <span class="icon"><i class="far fa-shopping-basket"></i></span>
                    <h4>Tổng đơn hàng <span>({{ $totalOrders }})</span></h4>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-md-4">
                <div class="fp__dsahboard_overview_item green">
                    <span class="icon"><i class="far fa-shopping-basket"></i></span>
                    <h4>Hoàn thành <span>({{ $totalCompleteOrders }})</span></h4>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-md-4">
                <div class="fp__dsahboard_overview_item red">
                    <span class="icon"><i class="far fa-shopping-basket"></i></span>
                    <h4>Đã hủy <span>({{ $totalCancelOrders }})</span></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="fp_dash_personal_info">
        <h4>Thông tin cá nhân
            <a class="dash_info_btn">
                <span class="edit">Sửa</span>
                <span class="cancel">Hủy</span>
            </a>
        </h4>

        <div class="personal_info_text">
            <p><span>Tên:</span> {{ auth()->user()->name }}</p>
            <p><span>Email:</span> {{ auth()->user()->email }}</p>
        </div>

        <div class="fp_dash_personal_info_edit comment_input p-0">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="fp__comment_imput_single">
                            <label>Tên</label>
                            <input type="text" placeholder="Tên" name="name" value="{{ auth()->user()->name }}">
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <div class="fp__comment_imput_single">
                            <label>Email</label>
                            <input type="email" placeholder="Email" name="email" value="{{ auth()->user()->email }}">
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <button type="submit" class="common_btn">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
