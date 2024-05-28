@extends('admin.layouts.app')

@section('title', 'Catogory List')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    @if (session('updateSuccess'))
                            <div class="col-6 offset-3">
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    <i class="fa-solid fa-check me-2"></i><strong>{{ session('updateSuccess') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="m-3 text-center">Product Info</h3>
                            </div>
                            <hr>

                            <div class="row px-5">
                                <div class="col-4">
                                    <label for="">Image</label>
                                    <img class="img-thumbnail shadow-sm"
                                        src="{{asset('storage/'.$pizza->image)}}" alt="">

                                </div>
                                <div class="col-6 offset-1">
                                    <h5 class='my-3'>{{ $pizza->name }}
                                    </h5>
                                    <h5 class='my-3'><i class="fa-brands fa-buffer me-2"></i>{{ $pizza->category_name }}
                                    </h5>
                                    <div class="d-flex">
                                        <h6 class='my-3 me-2 bg-dark text-white p-2 rounded-2'><i class="fa-solid fa-money-bill-wave me-2"></i>{{ $pizza->price }}</h6>
                                        <h6 class='my-3 me-2 bg-dark text-white p-2 rounded-2'><i class="fa-solid fa-clock me-2"></i>{{ $pizza->waiting_time }}</h6>
                                        <h6 class='my-3 me-2 bg-dark text-white p-2 px-4 rounded-2'><i class="fa-solid fa-eye me-2"></i>{{ $pizza->view_count }}</h6>
                                        <h6 class='my-3 me-2 bg-dark text-white p-2 rounded-2'><i
                                            class="fa-solid fa-user-clock me-2"></i>{{ $pizza->created_at->format('j-F-Y') }}
                                        </h6>
                                    </div>

                                    <h6>Description</h6>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="6" disabled>{{ $pizza->description }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4 offset-4 mt-3">
                                    <a href="{{ route('product#edit',$pizza->id) }}">
                                        <button class='btn bg-dark text-white'>
                                            <i class="fa-solid fa-file-pen me-2"></i>Edit Profile
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
