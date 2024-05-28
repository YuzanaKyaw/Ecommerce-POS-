@extends('admin.layouts.app')

@section('title', 'Catogory List')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
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
                            <div class="card-title">
                                <h3 class="m-3 text-center">Account Info</h3>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'female')
                                            <img src="{{asset('image/female_default.png')}}" class="shadow-sm" alt="">
                                        @else
                                            <img src="{{asset('image/default_user_profile.png')}}" class="shadow-sm" alt="">
                                        @endif

                                    @else
                                        <img class="img-thumbnail shadow-sm"
                                            src="{{asset('storage/'.Auth::user()->image)}}" style="width:300px; height:300px;" alt="">
                                    @endif
                                </div>
                                <div class="col-5 offset-1">
                                    <h4 class='my-3'><i class="fa-solid fa-user-pen me-2"></i>{{ Auth::user()->name }}
                                    </h4>
                                    <h4 class='my-3'><i class="fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}
                                    </h4>
                                    <h4 class='my-3'><i class="fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}</h4>
                                    <h4 class='my3'><i
                                            class="fa-solid fa-mars-and-venus me-2"></i>{{ Auth::user()->gender }}</h4>
                                    <h4 class='my-3'><i
                                            class="fa-solid fa-address-card me-2"></i>{{ Auth::user()->address }}</h4>
                                    <h4 class='my-3'><i
                                            class="fa-solid fa-user-clock me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}
                                    </h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4 offset-2 mt-3">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class='btn bg-dark text-white'>
                                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile
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
