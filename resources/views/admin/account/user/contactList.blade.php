@extends('admin.layouts.app')

@section('title','Contact List')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            @if (session('successMessage'))
            <div class="col-4 offset-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check"></i><strong>{{ session('successMessage') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            @if (session('deleteSuccess'))
            <div class="col-4 offset-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check"></i><strong>{{ session('deleteSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Contact List</h2>

                        </div>
                    </div>

                </div>

                <div class="row">
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
                </div>
                <div class="row">
                    <div class="col-1 offset-11 bg-dark-50 shadow-lg py-1 px-3 mt-3 text-center">
                        <h3><i class="fa-solid fa-database me-2"></i>{{$contactMessage->total()}}</h3>
                    </div>
                </div>
                {{-- @if (count($categories) != 0) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contactMessage as $user)
                                <tr class='tr-shadow'>
                                    <td></td>
                                    <td class='col-2'>{{ $user->name }}</td>
                                    <td class='col-3'>{{ $user->email }}</td>
                                    <td class='col-5'>{{ $user->message }}</td>
                                    <td class='col-2'>
                                        <div class="table-data-feature">
                                            <a href="{{ route('admin#replyPage',$user->contact_id) }}">
                                                <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Reply">
                                                    <i class="fa-solid fa-reply"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('admin#contactDelete',$user->contact_id) }}">
                                                <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>

                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>

                    <div class="">
                        {{ $contactMessage->links() }}
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
