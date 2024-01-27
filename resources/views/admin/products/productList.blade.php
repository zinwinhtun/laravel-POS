@extends('admin.layout.master')

@section('title', 'Product list')

@section('content')
    {{-- main content --}}
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Products List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href=" {{ route('product#create') }} ">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="fa-solid fa-plus"></i>Add Product
                                </button>
                            </a>
                        </div>
                    </div>
                    {{-- search key  --}}
                    <div class="row">
                        <div class="col-4">
                            <h4 class="text-muted">Total Item <i class="fa-solid fa-caret-right"></i> {{$pizzas->total()}} </h4>
                        </div>
                        <div class="col-4">
                            <h4 class="text-muted">Search Catagory :<span class="text-success">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class="col-4">
                            <form action=" {{ route('product#list') }} " method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search..."
                                        value="{{ request('key') }}">
                                    <button type="submit" class="btn btn-success "><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- delete message alert  --}}
                    @if (session('createSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="text-muted">{{ session('createSuccess') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    {{-- list table  --}}

                    @if (count($pizzas) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Pizza Name</th>
                                    <th>Category Name</th>
                                    <th>View </th>
                                    <th>Prices</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pizzas as $pList)
                                <tr class="tr-shadow ">
                                    <td class="col-2"><img src="{{ asset('storage/'.$pList->image)}}"  class="img-thumbnail shadow" alt=""></td>
                                    <td>{{$pList->name}}</td>
                                    <td>{{$pList->category_name}}</td>
                                    <td><i class="fa-solid fa-eye"></i> {{$pList->view_count}}</td>
                                    <td>{{$pList->price}} Kyat</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{route('product#view',$pList->id)}}">
                                                <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            </a>
                                            <a href="{{route('product#edit',$pList->id)}}">
                                                <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                title="Edit">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            </a>
                                            <a href="{{route('product#delete',$pList->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash-arrow-up"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{ $pizzas->links() }}
                        </div>
                    </div>
                    @else
                    <h3 class="text-center mt-5 text-muted">There is no product here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
