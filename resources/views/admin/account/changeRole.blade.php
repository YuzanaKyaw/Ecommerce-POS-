@extends('admin.layouts.app')

@section('title','Catogory List')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-5">
                            <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        <hr>

                        <form action="{{route('admin#change',$account->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1 mt-4">
                                    @if ($account->image == null)
                                        @if ($account->gender == 'female')
                                            <img src="{{asset('image/female_default.png')}}" class="shadow-sm" alt="">
                                        @else
                                            <img src="{{asset('image/default_user_profile.png')}}" class="shadow-sm" alt="">
                                        @endif

                                    @else
                                    <img class="img-thumbnail shadow-sm"
                                    src="{{asset('storage/'.$account->image)}}" style="width:300px; height:300px;" alt="">
                                    @endif

                                    <div class="mt-3">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="">
                                        @error('image')
                                            <div class=" invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button class='btn bg-dark text-white col-12' type='submit'>
                                            <i class="fa-solid fa-file-pen me-2"></i>Change
                                        </button>
                                    </div>
                                </div>

                                <div class="row col-6 mt-4">
                                    {{-- <input type="hidden" name="id" value="{{$account->id}}"> --}}
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" disabled class="form-control" value="{{$account->name}}" aria-required="true" aria-invalid="false" placeholder="Enter name">
                                        @error('name')
                                            <div class=" invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Role</label>
                                        {{-- <input id="cc-pament" name="role" type="text" class="form-control" value="{{$account->role}}" aria-required="true" aria-invalid="false" dissable> --}}
                                        <select name="role" id="" class="form-control mb-1">
                                            <option value="admin" @if($account->role == 'admin') selected @endif>Admin</option>
                                            <option value="user" @if($account->role == 'user') selected @endif>User</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="email" disabled class="form-control" value="{{$account->email}}" aria-required="true" aria-invalid="false" placeholder="Enter email">
                                        @error('email')
                                            <div class=" invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="text" disabled class="form-control" value="{{$account->phone}}" aria-required="true" aria-invalid="false" placeholder="09xxxxxxxxx">
                                        @error('phone')
                                            <div class=" invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control" id="" disabled>
                                            <option value="">Choose gender...</option>
                                            <option value="male" @if ($account->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if($account->gender == 'female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                            <div class=" invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Address</label>
                                        <textarea name="address" class='form-control' disabled id="" cols="30" rows="10" value="" placeholder="Enter address">{{$account->address}}</textarea>
                                        @error('address')
                                            <div class=" invalid-feedback">{{$message}}</div>
                                        @enderror
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

