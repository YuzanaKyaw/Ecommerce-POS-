@extends('admin.layouts.app')

@section('title','User List')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">User List</h2>

                        </div>
                    </div>

                </div>

                @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i><strong>{{session('deleteSuccess')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

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
                        <h3><i class="fa-solid fa-database"></i>{{ $users->total() }}  </h3>
                    </div>
                </div>
                {{-- @if (count($categories) != 0) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>User Id</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class='tr-shadow'>
                                    <input type="hidden" name="" value={{$user->id}} class="userId">
                                    <td class="col-2">
                                        @if ($user->image == null)
                                            @if ($user->gender == 'female')
                                                <img src="{{asset('image/female_default.png')}}" alt="">
                                            @else
                                                <img src="{{asset('image/default_user_profile.png')}}" class="shadow-sm" alt="">
                                            @endif

                                        @else
                                            <img src="{{ asset('storage/'.$user->image) }}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>

                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->phone}}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        <select name="changeStatus" class='form-control changeStatus' id="changeStatus">
                                            <option value="user" @if ($user->role == 'user') selected @endif>User</option>
                                            <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            @if (Auth::user()->id == $user->id)

                                            @else
                                                <a href="{{ route('admin#userDelete',$user->id) }}">
                                                    <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>

                                            @endif

                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>

                    <div class="">
                        {{ $users->links() }}
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

@section('scriptSection')
<script>
    $(document).ready(function(){
        $('.changeStatus').change(function(){
            $parentNode = $(this).parents('tr');
            $currentStatus = $(this).val();
            $userId = $parentNode.find('.userId').val();
            $data = {
                'role' : $currentStatus,
                'userId' : $userId
            }

            $.ajax({
                type : 'get',
                url: 'http://localhost/pizza_order_system/public/user/change/role',
                data: $data,
                dataType: 'json',
            })
            window.location.reload();
        })
    })
</script>

@endsection
