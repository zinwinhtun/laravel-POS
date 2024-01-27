@extends('admin.layout.master')

@section('title', 'Category list')

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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="fa-solid fa-plus"></i>Add item
                                </button>
                            </a>
                        </div>
                    </div>
                    {{-- search key  --}}
                    <div class="row">
                        <div class="col-4">
                            <h4 class="text-muted">Total Item  <i class="fa-solid fa-caret-right"></i> {{ $categories->total() }}  </h4>
                        </div>
                        <div class="col-4">
                            <h4 class="text-muted">Search Catagory :<span class="text-success">{{request('key')}}</span></h4>
                        </div>
                        <div class="col-4">
                            <form action=" {{ route('category#list') }} " method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search..."  value="{{request('key')}}">
                                    <button type="submit" class="btn btn-success "><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- delete message alert  --}}
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <span class="text-muted"><i class="fa-solid fa-trash-arrow-up mx-1"></i>{{session('deleteSuccess')}}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    {{-- list table  --}}
                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Create Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow ">
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{route('category#edit',$category->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </button>
                                                    </a>
                                                    <a href=" {{ route('category#delete', $category->id) }} ">
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
                                {{ $categories->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @else
                        <h3 class="text-center mt-5 text-muted">There is no category here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
