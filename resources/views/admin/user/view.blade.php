@extends('admin.layout.master')

@section('title', 'Account Detail')

@section('content')
    {{-- main content --}}
    <div class="main-content">
        <div class="row">
            <div class="col-3 offset-7">
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid mt-2">
                <a href="{{route('admin#userList')}}" class="text-dark fw-bolder"><i class="fa-solid fa-caret-left "></i> Back</a>
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
                                    @if ($user[0]->image == null)
                                        <img src=" {{ asset('image/user.png') }}" class="shadow " alt="Cool Admin" />
                                    @else
                                        <img src=" {{ asset('storage/'.$user[0]->image) }}" class="shadow"
                                            alt="John Doe" />
                                    @endif
                                    <h3 class="m-4 text-center ">Type -{{$user[0]->role}} </h3>
                                </div>
                                {{-- account detail  --}}
                                <div class="col-5 ms-4 ">
                                    <h3 class="my-4"><i class="fa-solid fa-user-tie me-2"></i>{{ $user[0]->name }}</h3>
                                    <h3 class="my-4"><i class="fa-solid fa-at me-2"></i>{{$user[0]->email }}</h3>
                                    <h3 class="my-4"><i class="fa-solid fa-mobile-button me-2"></i>{{ $user[0]->phone }}</h3>
                                    <h3 class="my-4"><i class="fa-solid fa-venus-mars me-2"></i>{{$user[0]->gender}}</h3>
                                    <h3 class="my-4"><i class="fa-solid fa-location-dot me-2"></i>{{ $user[0]->address }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
