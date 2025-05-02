@extends('User::Front.master')

@section('content')
    <form method="POST" action="{{ route('login.submit') }}" class="form" >
        @csrf
        <a class="account-logo" href="/">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input id="email" type="text" class="txt-l txt @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                   placeholder="ایمیل یا شماره موبایل">
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

            <input id="password" type="password" class="txt-l txt @error('password') is-invalid @enderror"
                   placeholder="رمز عبور" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <br>
            <button class="btn btn--login">ورود</button>
            <label class="ui-checkbox">
                مرا بخاطر داشته باش
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="checkmark"></span>
            </label>
            <div class="recover-password">
                <a href="{{route('password.request')}}">بازیابی رمز عبور</a>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{route('register.show')}}">صفحه ثبت نام</a>
        </div>
    </form>
@endsection
