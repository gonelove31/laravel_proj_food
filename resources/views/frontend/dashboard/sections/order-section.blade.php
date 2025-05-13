<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="fp_dashboard_body">
        <h3>Danh sách đơn hàng</h3>
        <div class="fp_dashboard_order">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr class="t_header">
                            <th>Đơn hàng</th>
                            <th>Ngày</th>
                            <th>Trạng thái</th>
                            <th>Số tiền</th>
                            <th>Thao tác</th>
                        </tr>
                        @foreach ($orders as $order)
                        <tr>
                            <td>
                                <h5>#{{ $order->invoice_id }}</h5>
                            </td>
                            <td>
                                <p>{{ date('F d, Y', strtotime($order->created_at)) }}</p>
                            </td>
                            <td>
                                @if ($order->order_status === 'pending')
                                <span class="active">Chờ xử lý</span>
                                @elseif ($order->order_status === 'in_process')
                                <span class="active">Đang xử lý</span>
                                @elseif ($order->order_status === 'delivered')
                                <span class="complete">Đã giao</span>
                                @elseif ($order->order_status === 'declined')
                                <span class="cancel">Đã hủy</span>
                                @endif
                            </td>
                            <td>
                                <h5>{{ currencyPosition($order->grand_total) }}</h5>
                            </td>
                            <td>
                                <a class="view_invoice" onclick="viewInvoice('{{ $order->id }}')">Xem chi tiết</a>
                                @if ($order->order_status === 'pending')
                                <a href="javascript:;" class="cancel_order" onclick="openCancelModal('{{ $order->id }}')">Hủy đơn</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        @foreach ($orders as $order)
        <div class="fp__invoice invoice_details_{{ $order->id }}">
            <a class="go_back d-print-none"><i class="fas fa-long-arrow-alt-left"></i> quay lại</a>
            <div class="fp__track_order d-print-none">
                <ul>
                    @if ($order->order_status === 'declined')
                    <li class="
                    declined_status
                    {{ in_array($order->order_status, ['declined']) ? 'active' : '' }}
                    ">đơn hàng đã hủy</li>
                    @else
                    <li class="
                    {{ in_array($order->order_status, ['pending', 'in_process', 'delivered', 'declined']) ? 'active' : '' }}
                    ">đơn hàng chờ xử lý</li>
                    <li class="
                    {{ in_array($order->order_status, ['in_process', 'delivered', 'declined']) ? 'active' : '' }}
                    ">đơn hàng đang xử lý</li>
                    <li class="
                    {{ in_array($order->order_status, ['delivered']) ? 'active' : '' }}
                    ">đơn hàng đã giao</li>
                    @endif
                    {{-- <li>on decliend</li> --}}
                </ul>
            </div>
            <div class="fp__invoice_header">
                <div class="header_address">
                    <h4>invoice to</h4>
                    <p>{{ @$order->userAddress->first_name }}</p>
                    <p>{{ $order->address }}</p>
                    <p>{{ @$order->userAddress->phone }}</p>
                    <p>{{ @$order->userAddress->email }}</p>

                </div>
                <div class="header_address" style="width: 50%">
                    <p><b style="width: 140px">invoice no: </b><span>{{ @$order->invoice_id }}</span></p>
                    <p><b style="width: 140px">Payment Status: </b><span>{{ @$order->payment_status }}</span></p>
                    <p><b style="width: 140px">Payment Method: </b><span>{{ @$order->payment_method }}</span></p>
                    <p><b style="width: 140px">Transaction Id: </b><span>{{ @$order->transaction_id }}</span></p>



                    <p><b style="width: 140px">date:</b> <span>{{ date('d-m-Y', strtotime($order->created_at)) }}</span></p>
                </div>
            </div>
            <div class="fp__invoice_body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr class="border_none">
                                <th class="sl_no">SL</th>
                                <th class="package">item description</th>
                                <th class="price">Price</th>
                                <th class="qnty">Quantity</th>
                                <th class="total">Total</th>
                            </tr>

                            @foreach ($order->orderItems as $item)
                            @php
                                $size = json_decode($item->product_size);
                                $options = json_decode($item->product_option);

                                $qty = $item->qty;
                                $untiPrice = $item->unit_price;
                                $sizePrice = $size->price ?? 0;

                                $optionPrice = 0;
                                foreach ($options as $optionItem) {
                                    $optionPrice += $optionItem->price;
                                }

                                $productTotal = ($untiPrice + $sizePrice + $optionPrice) * $qty;
                            @endphp
                            <tr>
                                <td class="sl_no">{{ ++$loop->index }}</td>
                                <td class="package">
                                    <p>{{ $item->product_name }}</p>
                                    <span class="size">{{ @$size->name }} - {{ @$size->price ? currencyPosition(@$size->price) : ''}}</span>
                                    @foreach ($options as $option)
                                    <span class="coca_cola">{{ @$option->name }} - {{ @$option->price ? currencyPosition(@$option->price) : '' }}</span>
                                    @endforeach
                                </td>
                                <td class="price">
                                    <b>{{ currencyPosition($item->unit_price) }}</b>
                                </td>
                                <td class="qnty">
                                    <b>{{ $item->qty }}</b>
                                </td>
                                <td class="total">
                                    <b>{{ currencyPosition($productTotal) }}</b>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="package" colspan="3">
                                    <b>sub total</b>
                                </td>
                                <td class="qnty">
                                    <b>-</b>
                                </td>
                                <td class="total">
                                    <b>{{ currencyPosition($order->subtotal) }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td class="package coupon" colspan="3">
                                    <b>(-) Discount coupon</b>
                                </td>
                                <td class="qnty">
                                    <b></b>
                                </td>
                                <td class="total coupon">
                                    <b>{{ currencyPosition($order->discount) }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td class="package coast" colspan="3">
                                    <b>(+) Shipping Cost</b>
                                </td>
                                <td class="qnty">
                                    <b></b>
                                </td>
                                <td class="total coast">
                                    <b>{{ currencyPosition($order->delivery_charge) }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td class="package" colspan="3">
                                    <b>Total Paid</b>
                                </td>
                                <td class="qnty">
                                    <b></b>
                                </td>
                                <td class="total">
                                    <b>{{ currencyPosition($order->grand_total) }}</b>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <a class="print_btn common_btn d-print-none" href="javascript:;" onclick="printInvoice('{{ $order->id }}')"><i class="far fa-print "></i> print
                PDF</a>

        </div>
        @endforeach
    </div>
</div>

@push('scripts')
    <script>
        function viewInvoice(id){
            $(".fp_dashboard_order").fadeOut();
            $(".invoice_details_"+id).fadeIn();
        }

        function openCancelModal(id) {
            $('#orderIdInput').val(id);
            $('#cancelOrderModal').modal('show');
        }

        function cancelOrder() {
            var id = $('#orderIdInput').val();
            var cancelReason = '';
            
            if ($('#otherReason').is(':checked')) {
                cancelReason = $('#customReason').val();
                if (!cancelReason) {
                    toastr.error('Please provide a reason for cancellation');
                    return;
                }
            } else {
                var selectedReason = $('input[name="cancel_reason"]:checked');
                if (selectedReason.length === 0) {
                    toastr.error('Please select a reason for cancellation');
                    return;
                }
                cancelReason = selectedReason.val();
            }
            
            $.ajax({
                url: "{{ route('cancel-order', '') }}/" + id,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    cancel_reason: cancelReason
                },
                success: function(response) {
                    if(response.status === 'success') {
                        $('#cancelOrderModal').modal('hide');
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    toastr.error('Something went wrong!');
                }
            });
        }

        $(document).ready(function() {
            $('#otherReason').change(function() {
                if($(this).is(':checked')) {
                    $('#customReasonContainer').show();
                } else {
                    $('#customReasonContainer').hide();
                }
            });
        });

        function printInvoice(id) {
            let printContents = $('.invoice_details_'+id).html();

            let printWindow = window.open('', '', 'width=600,height=600');
            printWindow.document.open();
            printWindow.document.write('<html>');
            printWindow.document.write('<link rel="stylesheet" href="{{ asset("frontend/css/bootstrap.min.css") }}">');
            printWindow.document.write('<link rel="stylesheet" href="{{ asset("frontend/css/style.css") }}');

            printWindow.document.write('<body>');
            printWindow.document.write(printContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            printWindow.print();
            printWindow.close();
        }
    </script>
@endpush

<!-- Cancel Order Modal -->
<div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelOrderModalLabel">Cancel Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="orderIdInput">
                <p>Please select a reason for cancellation:</p>
                
                <div class="cancellation-reasons">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="cancel_reason" id="reason1" value="Changed my mind">
                        <label class="form-check-label" for="reason1">Changed my mind</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="cancel_reason" id="reason2" value="Ordered by mistake">
                        <label class="form-check-label" for="reason2">Ordered by mistake</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="cancel_reason" id="reason3" value="Found better price elsewhere">
                        <label class="form-check-label" for="reason3">Found better price elsewhere</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="cancel_reason" id="reason4" value="Delivery time is too long">
                        <label class="form-check-label" for="reason4">Delivery time is too long</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="cancel_reason" id="otherReason" value="other">
                        <label class="form-check-label" for="otherReason">Other reason</label>
                    </div>
                    
                    <div id="customReasonContainer" style="display: none;">
                        <textarea id="customReason" class="form-control mt-2" placeholder="Please specify your reason"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="cancelOrder()">Cancel Order</button>
            </div>
        </div>
    </div>
</div>
