@extends('admin.layout.master')

@section('title', 'Pizza Detail')

@section('content')
    {{-- main content --}}
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid mt-2">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                                <h3>
                                        <i class="fa-solid fa-arrow-left-long text-dark" onclick="history.back()"></i>
                                </h3>
                            <div class="card-title">
                                <h3 class="text-center  title-2">Product Detail <i
                                        class="fa-solid fa-tachograph-digital ms-2"></i></h3>
                            </div>
                            <hr>
                            <div class="row">
                                {{-- image  --}}
                                <div class="col-4">

                                    <img src=" {{ asset('storage/' . $pizza->image) }}" class="shadow " />
                                </div>
                                {{-- account detail  --}}
                                <div class="col-7 ms-4 ">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="">Name - {{ $pizza->name }}</h4>
                                        <p>{{ $pizza->created_at->format('d-m-Y') }}</p>
                                    </div>
                                    <div class="fw-bolder text-dark">category - {{$pizza->category_name}}</div>
                                    <div class="my-2 fw-bolder text-dark">Pizza Detail</div>
                                    <p class="">{{ $pizza->description }} </p>
                                    <div class="row d-flex ">
                                        <span class="my-4 col btn btn-dark text-light me-1"><i class="fa-solid fa-clock-rotate-left me-1"></i>
                                            {{ $pizza->waiting_time }} mins</span>
                                        <span class="my-4 col btn btn-dark text-light me-1"><i class="fa-solid fa-hand-holding-dollar me-1"></i>
                                            {{ $pizza->price }} Kyat</span>
                                        <span class="my-4 col btn btn-dark text-light me-1">View -
                                            {{ $pizza->view_count }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
