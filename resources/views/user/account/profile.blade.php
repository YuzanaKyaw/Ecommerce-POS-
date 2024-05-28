@extends('user.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">User Profile</h3>
                        </div>
                        <hr>

                        <form action="{{route('user#accountUpadate',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-3 offset-1 mt-4">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'female')
                                            <img src="{{asset('image/female_default.png')}}" style="width:300px; height:300px;" class="shadow-sm" alt="">
                                        @else
                                            <img src="{{asset('image/default_user_profile.png')}}" style="width:300px; height:300px;" class="shadow-sm" alt="">
                                        @endif

                                    @else
                                    <img class="img-thumbnail shadow-sm"
                                    src="{{asset('storage/'.Auth::user()->image)}}" style="width:300px; height:300px;" alt="">
                                    @endif

                                    <div class="mt-3">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="">
                                        @error('image')
                                            <div class=" invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button class='btn bg-dark text-white col-12' type='submit'>
                                            <i class="fa-solid fa-file-pen me-2"></i>Update
                                        </button>
                                    </div>
                                </div>

                                <div class="col-6 offset-1 mt-4">
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{Auth::user()->name}}" aria-required="true" aria-invalid="false" placeholder="Enter name">
                                        @error('name')
                                            <div class=" invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{Auth::user()->email}}" aria-required="true" aria-invalid="false" placeholder="Enter email">
                                        @error('email')
                                            <div class=" invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{Auth::user()->phone}}" aria-required="true" aria-invalid="false" placeholder="09xxxxxxxxx">
                                        @error('phone')
                                            <div class=" invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                                            <option value="">Choose gender...</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if(Auth::user()->gender == 'female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                            <div class=" invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Address</label>
                                        <textarea name="address" class='form-control @error('address') is-invalid @enderror' id="" cols="30" rows="10" value="" placeholder="Enter address">{{Auth::user()->address}}</textarea>
                                        @error('address')
                                            <div class=" invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Role</label>
                                        <input id="cc-pament" name="role" type="text" class="form-control" value="{{Auth::user()->role}}" aria-required="true" aria-invalid="false" disabled>

                                    </div>
                                </div>
                            </div>


                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
