@extends("admin.layouts.app")

@section('title','Order List')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <a href="{{route('admin#orderList')}}" class='text-decoration-none text-secondary'>
                <i class="fa-solid fa-backward me-2"></i>back
            </a>
            <div class="row mt-3">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class='text-center'><i class="fa-solid fa-receipt"></i>Order Info</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col"><i class="fa-solid fa-user me-3"></i>Customer name</div>
                                <div class="col">{{ strtoupper($orderList[0]->user_name) }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><i class="fa-solid fa-barcode me-3"></i>Order Code</div>
                                <div class="col">{{ $orderList[0]->order_code }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><i class="fa-regular fa-calendar me-3"></i>Order Date</div>
                                <div class="col">{{ $orderList[0]->created_at->format('j-F-Y') }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><i class="fa-solid fa-money-check-dollar me-3"></i>Total</div>
                                <div class="col">{{ $orderTotal->total_price }} Kyats <span class='text-success'>(nclude Delivery Fee)</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-2">


                <!-- DATA TABLE -->
                {{-- <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>
                </div> --}}

                {{-- <div class="row">
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
                </div> --}}
                {{-- <div class="row">
                    <div class="col-1 offset-11 bg-dark-50 shadow-lg py-1 px-3 mt-3 text-center">
                        <h3><i class="fa-solid fa-database p-2"> </i> </h3>
                    </div>
                </div> --}}


                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Quantaty</th>
                                <th>Amount</th>

                            </tr>
                        </thead>
                        <tbody id='dataList'>
                            @foreach($orderList as $order)
                            <tr class='tr-shadow'>
                                <td></td>
                                <td class=''>{{ $order->id }}</td>
                                <td class=''>{{ $order->user_name }}</td>
                                <td class=''>{{ $order->product_name }}</td>
                                <td class='col-2'><img src="{{ asset('storage/'.$order->product_image) }}" alt=""></td>
                                <td class=''>{{ $order->qty }}</td>
                                <td class=''>{{ $order->product_price }}</td>
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


