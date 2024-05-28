@extends('admin.layouts.app')

@section('title','Product List')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('product#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Pizza
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>

                @if (session('createSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i><strong>{{session('createSuccess')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

                @if (session('productDelete'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i><strong>{{session('productDelete')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

                @if (session('updateSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check me-2"></i><strong>{{session('updateSuccess')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif



                <div class="row">
                    <div class="col-3">
                        <h5 class='text-secondary'>Search Key : <span class='text-success'>{{request('key')}}</span></h5>
                    </div>

                    <div class=" col-3 offset-6">
                        <form action="{{ route('product#list') }}" method="get">
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
                        <h3><i class="fa-solid fa-database"></i> {{$pizzas->total()}} </h3>
                    </div>
                </div>

                @if (count($pizzas) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>View Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pizzas as $pizza)
                                <tr class='tr-shadow'>
                                    <td class="col-2"><img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm" alt=""></td>
                                    <td class="">{{ $pizza->name }}</td>
                                    <td class="">{{ $pizza->category_name }}</td>
                                    <td class="">{{ $pizza->price }}</td>
                                    <td class=""><i class="fa-solid fa-eye me-2"></i>{{ $pizza->view_count }}</td>
                                    <td class="col-2">
                                        <div class="table-data-feature me-2">
                                            <a href="{{route('product#detail',$pizza->id)}}">
                                                <button class="item me-2" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fa-solid fa-file-lines me-2"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('product#edit',$pizza->id)}}">
                                                <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>

                                            <a href="{{ route('product#delete',$pizza->id) }}">
                                                <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                            {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </button> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{$pizzas->links()}}
                    </div>

                </div>
                @else
                    <h3 class='text-secondary mt-5 text-center'>There is no categories here</h3>
                @endif


                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

@endsection
