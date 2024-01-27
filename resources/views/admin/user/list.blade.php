@extends('admin.layout.master')

@section('title', 'User list')

@section('content')
    {{-- main content --}}
    <div class="main-content ">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">User List</h2>
                            </div>
                        </div>
                    </div>

                    {{-- user table  --}}

                    <div class="table-responsive table-responsive-data2 mt-2">
                        <p class="mb-3"><i>total user - {{ $users->total() }}</i></p>
                        <table class="table table-data2 ">
                            <thead class="bg-dark ">
                                <tr>
                                    <th class="text-white ">User Image</th>
                                    <th class="text-white">User Name</th>
                                    <th class="text-white">E-Mail</th>
                                    <th class="text-white">Gender </th>
                                    <th class="text-white">Phone</th>
                                    <th class="text-white ">Address</th>
                                    <th class="text-white">Role</th>
                                    <th class="text-white">Tools</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($users as $u)
                                    <tr class="tr-shadow ">
                                        <td >
                                            @if ($u->image == null)
                                                <img src="{{ asset('image/user.png') }}" class="w-100 rounded-top"
                                                    alt="">
                                            @else
                                                <img src="{{ asset('storage/' . $u->image) }}" class="w-100 rounded-top"
                                                    alt="">
                                            @endif
                                        </td>
                                        <input type="hidden" id="userId" value="{{ $u->id }}">
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->gender }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->address }}</td>
                                        <td>
                                            <select class="changeRole" id="">
                                                <option value="user" @if ($u->role == 'user') selected @endif>
                                                    User</option>
                                                <option value="admin" @if ($u->role == 'admin') selected @endif>
                                                    Admin</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('admin#userDelete', $u->id) }}" class="me-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="fa-solid fa-trash-arrow-up"></i>
                                                    </button>
                                                </a>
                                                <a href="{{route('admin#view' ,$u->id)}}" class="me-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-regular fa-address-book"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- script section  --}}

@section('scriptSection')
    <script>
        $(document).ready(function() {
            $('.changeRole').change(function() {
                $currentRole = $(this).val();
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find("#userId").val();
                console.log($userId);

                $.ajax({
                    type: 'get',
                    url: '/user/change/userRole',
                    data: {
                        'role': $currentRole,
                        'userId': $userId
                    },
                    dataType: 'json',
                }); //ajax end
                location.reload();
            })
        })
    </script>
@endsection
