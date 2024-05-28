@extends('admin.layouts.app')

@section('title', 'Catogory List')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create New Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="pizzaName" type="text"
                                        class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter your product name...">
                                    @error('pizzaName')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Category</label>
                                    <select name="pizzaCategory" id=""
                                        class="form-control @error('pizzaCategory') is-invalid @enderror">
                                        <option value="">Choose your category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pizzaCategory')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Description</label>
                                    <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" id=""
                                        cols="30" rows="10" placeholder="Enter you Description..."></textarea>
                                    @error('Description')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Image</label>
                                    <input id="cc-pament" name="pizzaImage" type="file"
                                        class="form-control @error('pizzaImage') is-invalid @enderror" aria-required="true"
                                        aria-invalid="false">
                                    @error('pizzaImage')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Waithing Time</label>
                                    <input id="cc-pament" name="pizzaWaitingTime" type="text"
                                        class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter product price...">
                                    @error('pizzaWaitingTime')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="pizzaPrice" type="text"
                                        class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter product price...">
                                    @error('pizzaPrice')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-circle-right"></i>
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
