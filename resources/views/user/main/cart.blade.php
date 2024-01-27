@extends('user.layout.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $CL)
                            <input type="hidden" name="productId">
                            <tr>
                                <td class="align-middle"><img class="img-thumbnail"
                                        src="{{ asset('storage/' . $CL->pizza_image) }}" style="width: 50px;height:50px;"
                                        alt=""></td>
                                <td class="align-middle">
                                    <input type="hidden" class="productId" value="{{ $CL->product_id }}">
                                    <input type="hidden" class="userId" value="{{ $CL->user_id }}">
                                    <input type="hidden" class="orderId" value="{{ $CL->id }}">
                                    {{ $CL->pizza_name }}
                                </td>
                                <td class="align-middle" id="price">{{ $CL->pizza_price }} MMK</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            id="qty" value="{{ $CL->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $CL->pizza_price * $CL->qty }} MMK</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Order Total Price</h6>
                            <h6 id="subTotal">{{ $totalPrice }} MMK</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">2000 MMK</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ $totalPrice + 2000 }} MMK</h5>
                        </div>
                        <div class="row">
                            <div class="col-6"> <button class="btn btn-block  btn-success  my-3 " id="orderBtn">Take
                                    Order</button></div>
                            <div class="col-6"> <button class="btn btn-block  btn-danger  my-3 " id="clearBtn">Order
                                    Cancel</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        $('#orderBtn').click(function() {
            $orderList = [];
            $random = Math.floor(Math.random() * 100000001)
            $('#dataTable tbody tr').each(function(index, row) {

                $orderList.push({
                    'user_id': $(row).find('.userId').val(),
                    'product_id': $(row).find('.productId').val(),
                    'qty': $(row).find('#qty').val(),
                    'total': $(row).find('#total').text().replace(' MMK', '') * 1,
                    'order_code': "POS" + $random
                });

            });

            $.ajax({
                type: 'get',
                url: '/user/ajax/order',
                data: Object.assign({}, $orderList),
                dataType: 'json',
                success: function(response) {
                    if (response.status == "true") {
                        window.location.href = '/user/homePage';
                    }
                }
            })
        });

        //when order cencel
        $('#clearBtn').click(function() {
            $('#dataTable tbody tr').remove(); // remove order list
            $('#subTotal').html(' 0 MMK'); //remove order fee
            $('#finalPrice').html('2000 MMK'); // remove order fee and set delivary fee

            $.ajax({
                type: 'get',
                url: '/user/ajax/delete/cart',
                dataType: 'json',
            })
        });

        //for remove order
    $('.btnRemove').click(function(){

        $parentNode = $(this).parents("tr").remove();
        $productId = $parentNode.find('.productId').val();
        $orderId = $parentNode.find('.orderId').val();

        $.ajax({
                type: 'get',
                url: '/user/ajax/delete/order',
                data: {'productId' : $productId , 'orderId' : $orderId},
                dataType: 'json',
            })
        //summary calculation
        $totalPrice = 0 ;
        $('#dataTable tbody tr').each(function(index,row){
            $totalPrice += Number($(row).find('#total').text().replace(" MMK",""));
        });

        $('#subTotal').html(`${$totalPrice} MMK`);
        $('#finalPrice').html(`${$totalPrice + 2000} MMK`);
    })


    </script>
@endsection
