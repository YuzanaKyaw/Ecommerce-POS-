@extends('user.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <h2 class="title-1 text-center">Replies From Admins</h2>

                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive table-responsive-data2">
                                @foreach ($replies as $reply)
                                    <label for="">Reply</label>
                                    <textarea name="" id="" cols="30" class='form-control' rows="5" disabled>{{$reply->message}}</textarea>

                                @endforeach

                                <div class="">
                                    {{ $replies->links() }}
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
        </div>
    </div>
</div>

@endsection
