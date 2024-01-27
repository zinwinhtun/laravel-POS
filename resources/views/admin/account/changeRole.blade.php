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
                            <h3>
                                <i class="fa-solid fa-arrow-left-long text-dark" onclick="history.back()"></i>
                            </h3>
                            <div class="card-title">
                                <h3 class="text-center  title-2">Change Role <i class="fa-solid fa-people-arrows me-2"></i>
                                </h3>
                            </div>
                            <hr>
                            <form action=" {{ route('admin#change', $account->id) }} " method="POST"
                                enctype="multipart/form-data">@csrf
                                <div class="row px-2">
                                    <div class="col-4 offset-1 mt-3">
                                        <div class="text-center ">
                                            @if ($account->image == null)
                                                <img src=" {{ asset('image/user.png') }}" class="shadow img-thumbnail"
                                                    alt="Cool Admin" />
                                            @else
                                                <img src=" {{ asset('storage/' . $account->image) }}"
                                                    class="shadow img-thumbnail" alt="John Doe" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        {{-- name --}}
                                        <div class="form-group">
                                            <h4>Name = {{ $account->name }}</h4>
                                        </div>
                                        {{-- e-mail --}}
                                        <div class="form-group">
                                            <h4>E-Mail = {{ $account->email }}</h4>
                                        </div>
                                        {{-- phone --}}
                                        <div class="form-group">
                                            <h4>Phone = {{ $account->phone }}</h4>
                                        </div>
                                        {{-- gender --}}
                                        <div class="form-group">
                                            <h4>Sex = {{ $account->gender }}</h4>
                                        </div>
                                        {{-- address --}}
                                        <div class="form-group">
                                            <h4>location = {{ $account->address }}</h4>
                                        </div>
                                        {{-- role  --}}
                                        <div class="form-group">
                                            <p class="text-danger">You can only change role !</p>
                                            <label class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin') selected @endif>
                                                    Admin</option>
                                                <option value="user" @if ($account->role == 'user') selected @endif>
                                                    User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4 offset-4 mt-2">
                                        <a href="">
                                            <button class="btn btn-primary shadow"><i
                                                    class="fa-regular fa-floppy-disk me-2"></i>Change</button>
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
