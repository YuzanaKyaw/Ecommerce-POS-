@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id='dataTable'>
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $product)
                            <tr>
                                <td class="align-middle"><img src="{{ asset('storage/' . $product->product_image) }}"
                                        alt="" style="width: 50px;"></td>
                                <td class='align-middle'> {{ $product->pizza_name }}
                                    <input type="hidden" name="productId" id='productId'
                                        value="{{ $product->product_id }}">
                                    <input type="hidden" name="userId" id="userId" value="{{ $product->user_id }}">
                                    <input type="hidden" name="orderId" id="orderId" value="{{ $product->cart_id }}">
                                </td>
                                <td class="align-middle" id="price">{{ $product->pizza_price }} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-outline-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm border-0 text-center"
                                            id='qty' value="{{ $product->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-outline-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                {{-- <input type="hidden" name="" id='price' value="{{ $product->pizza_price }}"> --}}
                                <td class="align-middle" id='total'>{{ $product->pizza_price * $product->qty }}</td>
                                <td class="align-middle"><button id='' class="btn btn-sm btn-danger btn-remove"><i
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
                            <h6>Subtotal</h6>
                            <h6 id='subTotalPrice'>{{ $totalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id='finalTotal'>{{ $totalPrice + 3000 }} Kyats</h5>
                        </div>
                        <button id="orderBtn" class="btn btn-block btn-outline-primary font-weight-bold my-3 py-3">Proceed
                            To Checkout</button>

                        <button id="clearBtn" class="btn btn-block btn-outline-danger font-weight-bold my-3 py-3">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.btn-plus').click(function() {
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').text().replace('Kyats', ''));
                $qty = Number($parentNode.find('#qty').val());

                $total = $price * $qty

                $parentNode.find('#total').html($total + 'Kyats');

                //total summary
                summaryCalculation();

            })

            $('.btn-minus').click(function() {
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').text().replace('Kyats', ''));
                $qty = Number($parentNode.find('#qty').val());

                $total = $price * $qty

                $parentNode.find('#total').html($total + 'Kyats');


                summaryCalculation();
            })

            //remove current product
            $('.btn-remove').click(function() {
                $parentNode = $(this).parents('tr');
                $productId = $parentNode.find('#productId').val();
                $orderId = $parentNode.find('#orderId').val();
                $parentNode.remove();
                summaryCalculation();

                $.ajax({
                    type: 'get',
                    url: 'http://localhost/pizza_order_system/public/user/ajax/clear/current/product',
                    data: {'productId' : $productId, 'orderId' : $orderId},
                    dataType: 'json',
                })

            })

            $('#clearBtn').click(function(){
                $.ajax({
                    type: 'get',
                    url: 'http://localhost/pizza_order_system/public/user/ajax/clear/cart',
                    dataType: 'json',

                })
                $('#dataTable tbody tr').remove();
                $('#subTotalPrice').html('0 Kyats');
                $('#finalTotal').html('3000 Kyats');

            })

            function summaryCalculation() {
                $subTotal = 0;
                $('#dataTable tbody tr').each(function(index, row) {
                    $subTotal += $(row).find('#total').text().replace('Kyats', '') * 1;

                });

                $('#subTotalPrice').html(`${$subTotal} Kyats`);
                $('#finalTotal').html(`${$subTotal + 3000} Kyats`)
            }


        })
    </script>

    <script>
            $('#orderBtn').click(function() {
                    $orderList = [];
                    $random = Math.floor(Math.random() * 100001)
                    $('#dataTable tbody tr').each(function(index, row) {
                        $orderList.push({
                            'user_id': $(row).find('#userId').val(),
                            'product_id': $(row).find('#productId').val(),
                            'qty': $(row).find('#qty').val(),
                            'total': $(row).find('#total').text().replace('Kyats', '') * 1,
                            'order_code': 'POS000' + $random,
                        });
                    });
                    console.log($orderList);
                    $.ajax({
                            type: 'get',
                            url: 'http://localhost/pizza_order_system/public/user/ajax/order',
                            data: Object.assign({}, $orderList),
                            dataType: 'json',
                            success: function(response) {
                                if(response.status == 'true'){
                                    window.location.href = 'http://localhost/pizza_order_system/public/user/home'
                                }
                            }

                    })
            })

    </script>
@endsection
