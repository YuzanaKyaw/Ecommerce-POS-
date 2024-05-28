@extends("admin.layouts.app")

@section('title','Order List')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <h5 class='text-secondary'>Search Key : <span class='text-success'>{{request('key')}}</span></h5>
                    </div>

                    <div class=" col-3 offset-6">
                        <form action="" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" class='form-control' id="" placeholder="Search..." value='{{request('key')}}'>
                                <button class="btn btn-dark text-white" type='submit'><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 offset-11 bg-dark-50 shadow-lg py-1 px-3 mt-3 text-center">
                        <h3><i class="fa-solid fa-database p-2"> {{count($orders)}} </i> </h3>
                    </div>
                </div>

                <form action="{{ route('admin#changeOrderStatus') }}" method="GET">
                    @csrf
                    <div class="input-group mb-3">
                        <label for="" class="mt-2 me-2">Order Status</label>
                        <select name="orderStatus" id="orderStatus" class="form-select col-2">
                            <option value="">All</option>
                            <option value="0" @if(request('orderStatus') == '0') selected @endif>Pending</option>
                            <option value="1" @if(request('orderStatus') == '1') selected @endif>Accept</option>
                            <option value="2" @if(request('orderStatus') == '2') selected @endif>Reject</option>
                        </select>
                        <button class='btn btnsm btn-dark text-white input-group-text'>Search</button>
                      </div>
                </form>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Order Code</th>
                                <th>Order Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id='dataList'>
                            @foreach ($orders as $order)
                                <tr class='tr-shadow'>
                                    <input type="hidden" name="" id="orderId" value={{$order->id}}>
                                    <td>{{ $order->user_id}}</td>
                                    <td>{{ $order->user_name }}</td>
                                    <td>
                                        <a href="{{route('admin#listInfo',$order->oder_code)}}" class='text-decoration-none'>{{ $order->oder_code }}</a>
                                    </td>
                                    <td>{{ $order->created_at->format('j-F-Y') }}</td>
                                    <td class='amount'>{{ $order->total_price }}</td>
                                    <td>
                                        <select name="" id="" class="form-control statusChange">
                                            <option value="0" @if ($order->status == 0) selected @endif>Pending</option>
                                            <option value="1" @if ($order->status == 1) selected @endif>Accept</option>
                                            <option value="2" @if ($order->status == 2) selected @endif>Reject</option>
                                        </select>
                                    </td>

                                </tr>

                            @endforeach
                        </tbody>
                    </table>

                    <div class="">
                        {{-- {{ $categories->links()}} --}}
                        {{-- {{ $orders->appends(request()->query())->links() }} --}}
                    </div>

                </div>

                {{-- @else
                <h3 class='text-secondary mt-5 text-center'>There is no categories here</h3>

                @endif --}}
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('scriptSection')
    <script>
        $(document).ready(function(){
            // $('#orderStatus').change(function(){
            //     $status = $('#orderStatus').val();
            //     console.log($status)
            //     $.ajax({
            //         type : 'get',
            //         url: 'http://localhost/pizza_order_system/public/order/ajax/status',
            //         data: {'status' : $status},
            //         dataType: 'json',
            //         success: function(response){
            //             $list = ``;
            //             for($i=0; $i<response.length; $i++){

            //                 $months = ['January','February','March','April','May','June','July','August','September','November','December']

            //                 $dbDate = new Date(response[$i].created_at);
            //                 $finalDate = $months[$dbDate.getMonth()] +"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear();

            //                 if(response[$i].status == 0){
            //                     $statusMessage = `
            //                     <select name="" id="" class="form-control statusChange">
            //                         <option value="0" selected>Pending</option>
            //                         <option value="1">Accept</option>
            //                         <option value="2">Reject</option>
            //                     </select>
            //                     `;
            //                 }else if(response[$i].status == 1){
            //                     $statusMessage = `
            //                     <select name="" id="" class="form-control statusChange">
            //                         <option value="0">Pending</option>
            //                         <option value="1" selected>Accept</option>
            //                         <option value="2">Reject</option>
            //                     </select>
            //                     `;
            //                 }else if(response[$i].status == 2){
            //                     $statusMessage = `
            //                     <select name="" id="" class="form-control statusChange">
            //                         <option value="0">Pending</option>
            //                         <option value="1">Accept</option>
            //                         <option value="2" selected>Reject</option>
            //                     </select>
            //                     `;
            //                 }
            //                 $list += `
            //                 <tr class='tr-shadow'>
            //                     <input type="hidden" name="" id="orderId" value=${response[$i].id}>
            //                     <td> ${response[$i].user_id} </td>
            //                     <td> ${response[$i].user_name}  </td>
            //                     <td> ${response[$i].oder_code} </td>
            //                     <td> ${$finalDate} </td>
            //                     <td> ${response[$i].total_price}  </td>
            //                     <td> ${$statusMessage} </td>
            //                 </tr>
            //                 `;

            //             }
            //             $('#dataList').html($list);
            //         }
            //     })
            // })

            //change status
            $('.statusChange').change(function(){
                $parentNode = $(this).parents('tr');
                $currentStatus = $(this).val();
                $orderId = $parentNode.find('#orderId').val();

                $data = {
                    'currentStatus' : $currentStatus,
                    'orderId' : $orderId
                }

                $.ajax({
                    type: 'get',
                    url: 'http://localhost/pizza_order_system/public/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',

                })

            })




        })
    </script>

@endsection
