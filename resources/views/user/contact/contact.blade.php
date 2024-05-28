@extends('user.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-6 offset-3">
                @if (session('successMessage'))
                    <div class="col-8 offset-2">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i><strong>{{ session('successMessage') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Contact Us</h3>
                        </div>
                        <hr>

                        <form action="{{ route('user#sendMessage') }}" method="POST">
                            @csrf
                            <div class="col-8 offset-2 mb-2">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" value="{{Auth::user()->name}}">
                                @error('name')
                                    <div class=" invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-8 offset-2 mb-2">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="" value="{{Auth::user()->email}}">
                                @error('email')
                                    <div class=" invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-8 offset-2 mb-2">
                                <label for="">Message</label>
                                <textarea name="message" id="" class='form-control @error('message') is-invalid @enderror' cols="30" rows="10"></textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mt-3 col-8 offset-2">
                                <button type="submit" class='btn col-6 offset-3 btn-outline-primary'>
                                    Send<i class="fa-solid fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
