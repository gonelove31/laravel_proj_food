<!-- <section class="fp__download mt_100 xs_mt_70">
    <div class="fp__download_bg" style="background: url({{ @$appSection->background }});">
        <div class="fp__download_overlay">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-5 col-md-6 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__download_img">
                            <img src="{{ @$appSection->image }}" alt="download" class="img-fluid w-100">
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__download_text">
                            <div class="fp__section_heading mb_25">
                                <h4>Tải ứng dụng</h4>
                                <h2>Tải ứng dụng Dolphin ngay hôm nay</h2>
                                <p>Đặt món ăn yêu thích của bạn trực tuyến từ ứng dụng di động của chúng tôi. Tải xuống ứng dụng Dolphin ngay hôm nay và nhận ưu đãi đặc biệt cho lần đặt hàng đầu tiên của bạn.</p>
                            </div>
                            <ul class="d-flex flex-wrap">
                                @if (@$appSection->play_store_link)
                                <li>
                                    <a href="{{ @$appSection->play_store_link }}">
                                        <i class="fab fa-google-play"></i>
                                        <p> <span>Tải từ</span> google play </p>
                                    </a>
                                </li>
                                @endif
                                @if (@$appSection->apple_store_link)
                                <li>
                                    <a href="{{ @$appSection->apple_store_link }}">
                                        <i class="fab fa-apple"></i>
                                        <p> <span>Tải từ</span> apple store </p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
