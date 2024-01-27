@extends('admin.layout.master')

@section('title', 'Admin list')

@section('content')
    {{-- main content --}}
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    {{-- search key  --}}
                    <div class="row">
                        <div class="col-4">
                            <h4 class="text-muted">Total People <i class="fa-solid fa-caret-right"></i> {{$admin->total()}}</h4>
                        </div>
                        <div class="col-4">
                            <h4 class="text-muted">Search Admin :<span class="text-success">{{ request('key') }}</span></h4>
                        </div>
                        <div class="col-4">
                            <form action=" {{ route('admin#list') }} " method="GET">
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
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="text-muted"><i
                                        class="fa-solid fa-trash-arrow-up mx-1"></i>{{ session('deleteSuccess') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    {{-- list table  --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="col-2">Name</th>
                                    <th>E-Mail</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow ">
                                        <td>
                                            @if ($a->image == null)
                                                <img src="{{ asset('image/user.png') }}"  class="img-fluid rounded-top w-50" alt="">
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}"
                                                    class="img-fluid rounded-top w-50" alt="">
                                            @endif
                                        </td>
                                        <td class="col-2">{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <input type="hidden" class="roleId" value="{{ $a->id }}">
                                                @if (Auth::user()->id != $a->id)

                                                    <a href="{{route('admin#delete',$a->id)}}" class="me-2">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash-arrow-up"></i>
                                                        </button>
                                                    </a>
                                                    {{-- <a href="#"> --}}
                                                        {{-- {{route('admin#changeRole',$a->id)}} --}}
                                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Change Role">
                                                            <i class="fa-solid fa-person-military-to-person"></i>
                                                        </button> --}}
                                                        <select class="changeRole" id="">
                                                            <option value="admin" @if ($a->role == 'admin') selected @endif>Admin</option>
                                                            <option value="user" @if ($a->role == 'user') selected @endif>User</option>
                                                        </select>
                                                    {{-- </a> --}}
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{ $admin->links() }}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- script section  --}}

@section('scriptSection')
    <script>
        $(document).ready(function(){
            $('.changeRole').change(function(){
                $currentRole = $(this).val();
                $parentNode = $(this).parents("tr td");
                $roleId = $parentNode.find(".roleId").val();
                console.log($roleId);

                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/role',
                    data: {
                    'role': $currentRole,
                    'roleId': $roleId
                    },
                    dataType: 'json',
                }); //ajax end
                location.reload();
            })
        })
    </script>
@endsection
