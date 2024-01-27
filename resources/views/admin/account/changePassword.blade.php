@extends('admin.layout.master')

@section('title', 'Change Password')

@section('content')
    {{-- main content --}}
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid mt-5">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#changePassword') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Current Password</label>
                                    <input id="cc-pament" name="currentPassword" type="password"
                                        class="form-control @if (session('notMatch')) is-invalid @endif  @error('currentPassword') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Password...">
                                    {{-- validation error  --}}
                                    @error('currentPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    {{-- session error  --}}
                                    @if (session('notMatch'))
                                        <div class="invalid-feedback">
                                            {{ session('notMatch') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password"
                                        class="form-control @error('newPassword') is-invalid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter New Password...">

                                    @error('newPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Comfirm New Password</label>
                                    <input id="cc-pament" name="comfirmNewPassword" type="password"
                                        class="form-control @error('comfirmNewPassword') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false"
                                        placeholder="Enter Comfirm New Password...">
                                    @error('comfirmNewPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Change Password</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
