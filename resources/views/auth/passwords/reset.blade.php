@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> @lang('main.reset-title')</div>
               
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}" id="reset_form">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <!-- Email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('main.modal-email')</label>

                            <div class="col-md-6 reset">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                <span class="error" data-for="reset_email"></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">@lang('main.modal-passwd')</label>

                            <div class="col-md-6 reset">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <span class="error" data-for="reset_password"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Repeat password -->
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"> @lang('main.modal-repeat-passwd')</label>

                            <div class="col-md-6 reset">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <span class="error" data-for="reset_password_confirmation"></span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="reset_send" type="submit" class="btn btn-primary">
                                @lang('main.reset-title')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
