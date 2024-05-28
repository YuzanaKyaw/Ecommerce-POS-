@extends('admin.layouts.app')

@section('title','Reply')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-6 offset-3">
                <div class="m-2">
                    <a href="{{route('admin#contactList')}}" class="text-decoration-none text-black-50">
                        <i class="fa-solid fa-backward me-2"></i>back</a>
                </div>
                <div class="card">
                    <div class="card-body">

                        <div class="card-title">
                            <h3 class="text-center title-2">Contact Us</h3>
                        </div>
                        <hr>

                        <form action="{{ route('admin#sendReply') }}" method="POST">
                            @csrf
                            <div class="col-8 offset-2 mb-2">
                                <span><i class="fa-solid fa-reply me-2"></i>{{$contactInfo->name}}</span>
                                ( <small>{{$contactInfo->email}}</small> )
                                <input type="hidden" name="customerName" value="{{$contactInfo->name}}">
                                <input type="hidden" name="customerEmail" value="{{$contactInfo->email}}">
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
