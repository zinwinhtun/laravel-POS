@extends('admin.layout.master')

@section('title', 'Product Edit')

@section('content')
    {{-- main content --}}
    <div class="main-content ">
        <div class="section__content section__content--p30 ">
            <div class="container-fluid  ">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body ">
                            <div class="card-title">
                                <h3 class="text-center  title-2">Product Edit <i class="fa-solid fa-file-pen me-2"></i></h3>
                            </div>
                            <hr>
                            <form action=" {{ route('product#update') }} " method="POST"
                                enctype="multipart/form-data">@csrf
                                <div class="row px-2">
                                    <div class="col-4 offset-1">
                                        <div class="text-center my-5">

                                            <img src=" {{ asset('storage/' . $pizza->image) }}" class="shadow "
                                                 alt="Cool Admin" />

                                            <input type="hidden" name="pizzaId" value="{{$pizza->id}}">

                                        </div>
                                        <input type="file" name="pizzaImage"
                                            class="form-control  @error('pizzaImage') is-invalid @enderror" id="">
                                        @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        {{-- view count  --}}
                                        <h4 class="mt-3">View = {{$pizza->view_count}}</h4>
                                    </div>
                                    <div class="col-6 ">
                                        {{-- name --}}
                                        <div class="form-group">
                                            <label class="control-label mb-1">Pizza Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text"
                                                class="form-control @error('pizzaName') is-invalid @enderror"
                                                value="{{ old('pizzaName', $pizza->name) }} " aria-required="true"
                                                aria-invalid="false" placeholder="Enter  New Name...">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- category --}}
                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" id=""
                                                class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose category ... </option>
                                                @foreach ($category as $c)
                                                <option value="{{$c->id}}" @if ($pizza->category_id == $c->id) selected @endif>{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                {{-- Price --}}
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Price</label>
                                                    <input id="cc-pament" name="pizzaPrice" type="number"
                                                        class="form-control @error('pizzaPrice') is-invalid @enderror"
                                                        value="{{ old('pizzaPrice',$pizza->price)}}"
                                                        placeholder="123...">
                                                    @error('pizzaPrice')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                {{-- Waiting Time --}}
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Time</label>
                                                    <input id="cc-pament" name="pizzaWaitingTime" type="number"
                                                        class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                                        value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}"
                                                        placeholder="39 min...">
                                                    @error('pizzaWaitingTime')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        {{-- description --}}
                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <textarea id="cc-pament" aria-required="true" name="pizzaDescription" cols="30" rows="5"
                                                class="form-control @error('pizzaDescription') is-invalid @enderror" value="" aria-invalid="false"
                                                placeholder="Enter New Description...">{{ old('pizzaDescription', $pizza->description) }}
                                            </textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 offset-4 mt-5">
                                        <a href="">
                                            <button class="btn btn-primary "><i
                                                    class="fa-regular fa-floppy-disk me-2"></i>Save Profile</button>
                                        </a>
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
