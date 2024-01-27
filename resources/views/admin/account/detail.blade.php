@extends('admin.layout.master')

@section('title', 'Account Detail')

@section('content')
    {{-- main content --}}
    <div class="main-content">
        <div class="row">
            <div class="col-3 offset-7">
                @if (session('updateSuccess'))
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="text-muted"><i class="fa-solid fa-trash-arrow-up mx-1"></i>{{session('updateSuccess')}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid mt-2">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center  title-2">Account Info <i class="fa-regular fa-address-card ms-2"></i></h3>
                            </div>
                            <hr>
                            <div class="row">
                                {{-- image  --}}
                                <div class="col-5 mt-3 offset-1 ">
                                    @if (Auth::user()->image == null)
                                        <img src=" {{ asset('image/user.png') }}" class="shadow " alt="Cool Admin" />
                                    @else
                                        <img src=" {{ asset('storage/'.Auth::user()->image) }}" class="shadow"
                                            alt="John Doe" />
                                    @endif
                                    <h3 class="m-4 text-center ">Type -{{Auth::user()->role}} </h3>
                                </div>
                                {{-- account detail  --}}
                                <div class="col-5 ms-4 ">
                                    <h3 class="my-4"><i class="fa-solid fa-user-tie me-2"></i>{{ Auth::user()->name }}</h3>
                                    <h3 class="my-4"><i class="fa-solid fa-at me-2"></i>{{Auth::user()->email }}</h3>
                                    <h3 class="my-4"><i class="fa-solid fa-mobile-button me-2"></i>{{ Auth::user()->phone }}</h3>
                                    <h3 class="my-4"><i class="fa-solid fa-venus-mars me-2"></i>{{Auth::user()->gender}}</h3>
                                    <h3 class="my-4"><i class="fa-solid fa-location-dot me-2"></i>{{ Auth::user()->address }}</h3>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="text-center">
                                <a href="{{route('admin#edit')}}">
                                    <button class="btn btn-dark text-white px-5"><i class="fa-solid fa-user-pen me-2"></i>Edit Profile</button>
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
