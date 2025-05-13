<div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab">
    <div class="fp_dashboard_body address_body">
        <h3>Địa chỉ <a class="dash_add_new_address"><i class="far fa-plus"></i> thêm mới
            </a>
        </h3>
        <div class="fp_dashboard_address show_edit_address">
            <div class="fp_dashboard_existing_address">
                <div class="row">
                    @foreach ($userAddresses as $address)
                        <div class="col-md-6">
                            <div class="fp__checkout_single_address">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <span class="icon">
                                            @if ($address->type === 'home')
                                                <i class="fas fa-home"></i>
                                            @else
                                                <i class="far fa-car-building"></i>
                                            @endif

                                            {{ $address->type }}
                                        </span>
                                        <span class="address">{{ $address->address }},
                                            {{ $address->deliveryArea?->area_name }} </span>
                                    </label>
                                </div>
                                <ul>
                                    <li><a class="dash_edit_btn show_edit_section" data-class="edit_section_{{ $address->id }}"><i class="far fa-edit"></i></a></li>
                                    <li><a href="{{ route('address.destroy', $address->id) }}" class="dash_del_icon delete-item" ><i class="fas fa-trash-alt"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="fp_dashboard_new_address ">
                <form action="{{ route('address.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h4>thêm địa chỉ mới</h4>
                        </div>

                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form">
                                <select id="select_js3" name="area">
                                    <option value="">Chọn khu vực</option>
                                    @foreach ($deliveryAreas as $area)
                                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Tên" name="first_name">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Họ" name="last_name">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Số điện thoại" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Email" name="email">
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form">
                                <textarea cols="3" rows="4" placeholder="Địa chỉ" name="address"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="fp__check_single_form check_area">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1"
                                        value="home">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Nhà riêng
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="flexRadioDefault2"
                                        value="office">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Văn phòng
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="common_btn cancel_new_address">Hủy</button>
                            <button type="submit" class="common_btn">Lưu địa chỉ</button>
                        </div>
                    </div>
                </form>
            </div>
            @foreach ($userAddresses as $address)
            <div class="fp_dashboard_edit_address edit_section_{{ $address->id }}" >
                <form action="{{ route('address.update', $address->id) }}" method="Post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <h4>Sửa địa chỉ</h4>
                        </div>

                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form">
                                <select class="nice-select" name="area">
                                    <option value="">Chọn khu vực</option>
                                    @foreach ($deliveryAreas as $area)
                                        <option @selected($address->delivery_area_id === $area->id) value="{{ $area->id }}">{{ $area->area_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Tên" name="first_name" value="{{ $address->first_name }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Họ" name="last_name" value="{{ $address->last_name }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Số điện thoại" name="phone" value="{{ $address->phone }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Email" name="email" value="{{ $address->email }}">
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form">
                                <textarea cols="3" rows="4" placeholder="Địa chỉ" name="address">{!! $address->address !!}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="fp__check_single_form check_area">
                                <div class="form-check">
                                    <input @checked($address->type === 'home') class="form-check-input" type="radio" name="type"
                                        id="flexRadioDefault1" value="home">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Nhà riêng
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input @checked($address->type === 'office') class="form-check-input" type="radio" name="type"
                                        id="flexRadioDefault2" value="office">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Văn phòng
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="common_btn cancel_edit_address">Hủy</button>
                            <button type="submit" class="common_btn">Lưu địa chỉ</button>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.show_edit_section').on('click', function(){
                let className = $(this).data('class');
                $('.fp_dashboard_edit_address').removeClass('d-block');
                $('.fp_dashboard_edit_address').removeClass('d-none');

                $('.fp_dashboard_existing_address').addClass('d-none');
                $('.'+className).addClass('d-block');
            })

            $('.cancel_edit_address').on('click', function(){
                $('.fp_dashboard_edit_address').addClass('d-none');
                $('.fp_dashboard_existing_address').removeClass('d-none');
            })
        })
    </script>
@endpush
