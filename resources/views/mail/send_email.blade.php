<div class="row">
    <div class="col-lg-3"><h3>Thông tin đơn hàng</h3></div>
</div>
<div style="text-align: center">
    <div class="search_img_box">
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-6">
                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:65%">
                                    <h3>Sản Phẩm</h3>
                                </th>
                                <th style="width:35%">
                                    <h3>Tổng tiền</h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr data-id="{{ $id }}">
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-5 hidden-xs"><img src="{{ $details['image'] }}" width="100"
                                                height="100" class="img-responsive" /></div>
                                        <div class="col-sm-7">
                                            <p>
                                            <h4 class="nomargin">{{ $details['productName'] }}</h4>
                                            <h6> <b> Số lượng: {{ $details['quantity'] }}</b></h6>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    &emsp;&emsp;&emsp;
                                    <h4 class="nomargin" style="color: red">{{ number_format($details['price'] *$details['quantity'])}} đ</h4>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <tbody>
                                    <td colspan="5" class="text-center">
                                        <h3 style="color:red ;">
                                            <strong>Tổng cộng tiền thanh toán:{{ number_format($total)}}đ</strong>
                                        </h3>
                                    </td>
                                </tbody>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-sm-4">
                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>
                                    <h3>Thông tin khách hàng</h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h4>Tên khách hàng: </h4>
                                </td>
                                <td>
                                    <h4>{{$userAll->userName}}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Email: </h4>
                                </td>
                                <td>
                                    <h4>{{$userAll->email}}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Số điện thoại: </h4>
                                </td>
                                <td>
                                    <h4>{{$userAll->phone}}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Ngày sinh: </h4>
                                </td>
                                <td>
                                    <h4>{{ date('d/m/Y', strtotime($userAll->birthday))}}</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>