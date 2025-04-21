@extends('auth.master')

@section('content')
<div class="form">
    <a class="account-logo" href="index.html">
        <img src="/img/weblogo.png" alt="">
    </a>
    <div class="form-content form-account">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            یک لینک تایید ایمیل جدید به ایملیتان ارسال شد
                        </div>
                    @endif
        قبل از ادامه لطفا ایمیلتان را چک کنید. اگر ایمیلی دریافت نکردید درخواست ارسال مجدد لینک بدهید.
                    <form class="d-inline center" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">ارسال مجدد کد لینک تایید</button>
                        <a href="/"> بازگشت به صفحه اصلی</a>
                    </form>

            </div>
        </div>
@endsection
