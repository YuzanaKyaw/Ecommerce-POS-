@extends('user.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="">
                @if (session('pwdChangeSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i><strong>{{ session('pwdChangeSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                @if (session('accUpdateSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i><strong>{{ session('accUpdateSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        price</span></h5> --}}
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">
                            <label class=" mt-2" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($categories) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center justify-content-between mb-3 pt-1">
                            <a href="{{ route('user#home') }}" class='text-dark'>
                                <label class="" for="price-1">All</label>
                            </a>
                        </div>
                        @foreach ($categories as $category)
                            <div class="d-flex align-items-center justify-content-between mb-3 pt-1">
                                <a href="{{ route('user#filter', $category->id) }}" class='text-dark'>
                                    <label class="" for="price-1">{{ $category->name }}</label>
                                </a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->


                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cartList') }}">
                                    <button type="button" class="btn btn-dark text-white position-relative">
                                        <i class="fa-solid fa-cart-shopping me-2"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                          {{count($cart)}}
                                        </span>
                                      </button>
                                </a>
                                <a href="{{ route('user#history') }}" class='ms-3'>
                                    <button type="button" class="btn btn-dark text-white position-relative">
                                        <i class="fa-solid fa-clock-rotate-left"></i> History
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{count($history)}}
                                        </span>
                                      </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="dropdown">
                                    {{-- <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sorting
                                    </button> --}}
                                    {{-- <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#">Acending</a></li>
                                      <li><a class="dropdown-item" href="#">Descending</a></li>
                                      <li><a class="dropdown-item" href="#">Best Rating</a></li>
                                    </ul> --}}
                                    <select name="sorting" class="form-control" id="sortingOption">
                                        <option value="">Choose Sorting Option...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                                {{-- <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <span class="row" id="dataList">
                        @if (count($pizzas) != 0)
                            @foreach ($pizzas as $pizza)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id='myForm'>
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height:250px"
                                                src="{{ asset('storage/' . $pizza->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#pizzaDetails', $pizza->id) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $pizza->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $pizza->price }} Kyats</h5>
                                                {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center shadow-sm fs-1 py-4">There is no Pizza<i
                                    class="fa-solid fa-pizza-slice ms-2"></i></div>
                        @endif
                    </span>



                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        // $(document).ready(function(){
        //     $.ajax({
        //         type : 'get' ,
        //         url : 'http://localhost/pizza_order_system/public/user/ajax/pizza/list',
        //         dataType : 'json' ,
        //         success : function(response){
        //             console.log(response)
        //         }
        //     })
        // });
        $(document).ready(function() {
            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();

                if ($eventOption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://localhost/pizza_order_system/public/user/ajax/pizza/list',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = ``;
                            for ($i = 0; $i < response.length; $i++) {
                                //console.log(`${response[$i].name}`);
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                            <div class="product-item bg-light mb-4" id='myForm'>
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height:250px"
                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name} </a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5> ${response[$i].price} Kyats</h5>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                            }
                            $('#dataList').html($list);

                        }

                    })
                } else if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://localhost/pizza_order_system/public/user/ajax/pizza/list',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response)
                            $list = ``;
                            for ($i = 0; $i < response.length; $i++) {
                                //console.log(`${response[$i].name}`);
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                            <div class="product-item bg-light mb-4" id='myForm'>
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height:250px"
                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name} </a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5> ${response[$i].price} Kyats</h5>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                            }
                            $('#dataList').html($list);
                        }
                    })
                }
            })
        })
    </script>
@endsection

{{-- <div class="product-img position-relative overflow-hidden">
    <img class="img-fluid w-100" style="height:250px"
        src="{{ asset('storage/' . $pizza->image) }}" alt="">
    <div class="product-action">
        <a class="btn btn-outline-dark btn-square" href=""><i
                class="fa fa-shopping-cart"></i></a>
        <a class="btn btn-outline-dark btn-square" href=""><i
                class="fa-solid fa-circle-info"></i></a>
    </div>
</div>
<div class="text-center py-4">
    <a class="h6 text-decoration-none text-truncate" href="">{{ $pizza->name }}</a>
    <div class="d-flex align-items-center justify-content-center mt-2">
        <h5>{{ $pizza->price }} Kyats</h5>

    </div>
    <div class="d-flex align-items-center justify-content-center mb-1">
        <small class="fa fa-star text-primary mr-1"></small>
        <small class="fa fa-star text-primary mr-1"></small>
        <small class="fa fa-star text-primary mr-1"></small>
        <small class="fa fa-star text-primary mr-1"></small>
        <small class="fa fa-star text-primary mr-1"></small>
    </div>
</div> --}}
