@extends('admin.layout.master')

@section('title', 'Account Edit')

@section('content')
    {{-- main content --}}
    <div class="main-content ">
        <div class="section__content section__content--p30 ">
            <div class="container-fluid  ">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body ">
                            <div class="card-title">
                                <h3 class="text-center  title-2">Account Edit <i class="fa-solid fa-file-pen me-2"></i></h3>
                            </div>
                            <hr>
                            <form action=" {{ route('admin#update', Auth::user()->id) }} " method="POST" enctype="multipart/form-data">@csrf
                                <div class="row px-2">
                                    <div class="col-4 offset-1">
                                        <div class="text-center my-5">
                                            @if (Auth::user()->image == null)
                                                <img src=" {{ asset('image/user.png') }}" class="shadow "
                                                    alt="Cool Admin" />
                                            @else
                                                <img src=" {{ asset('storage/'.Auth::user()->image) }}" class="shadow "
                                                    alt="John Doe" />
                                            @endif
                                        </div>
                                        <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="">
                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <h4>Role = {{ Auth::user()->role }} </h4>
                                        </div>
                                        {{-- name --}}
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', Auth::user()->name) }} " aria-required="true"
                                                aria-invalid="false" placeholder="Enter  New Name...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- e-mail --}}
                                        <div class="form-group">
                                            <label class="control-label mb-1">E-Mail</label>
                                            <input id="cc-pament" name="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', Auth::user()->email) }} " aria-required="true"
                                                aria-invalid="false" placeholder="Enter New E-mail...">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- phone --}}
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone Number</label>
                                            <input id="cc-pament" name="phone" type="text"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ old('phone', Auth::user()->phone) }} " aria-required="true"
                                                aria-invalid="false" placeholder="Enter New Phome Number...">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- gender --}}
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" id=""
                                                class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose Gender ... </option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- address --}}
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <input id="cc-pament" name="address" type="text"
                                                class="form-control @error('address') is-invalid @enderror"
                                                value="{{ old('address', Auth::user()->address) }} " aria-required="true"
                                                aria-invalid="false" placeholder="Enter New Address...">
                                            @error('address')
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
