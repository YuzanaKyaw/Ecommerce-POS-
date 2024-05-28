@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" sytle="height:400px;">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id='dataTable'>
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($orders as $order)
                        <tr>
                            <td class="align-middle" id="price">{{ $order->created_at->format('j-F-y') }} </td>
                            <td class="align-middle" id="price">{{ $order->oder_code }} </td>
                            <td class="align-middle" id="price">{{ $order->total_price }} Kyats</td>
                            <td class="align-middle" id="price">
                                @if ($order->status == 0)
                                    <span class=" text-warning"><i class="fa-regular fa-clock me-2"></i>Pending...</span>
                                @elseif($order->status == 1)
                                    <span class=" text-success"><i class="fa-solid fa-check me-2"></i>Success</span>
                                @elseif($order->status == 2)
                                    <span class=" text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>Reject</span>
                                @endif
                            </td>
                            <td class="align-middle"><button id='' class="btn btn-sm btn-danger btn-remove"><i
                                class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class='mt-4'>{{$orders->links()}}</div>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection


