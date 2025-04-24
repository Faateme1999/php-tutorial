<x-mail::message>
# کد بازیابی رمز عبور حساب شما در tutorial

این ایمیل بخاطر درخواست جهت بازیابی رمز عبور ارسال شده!

{{--<x-mail::button :url="''">--}}
{{--Button Text--}}
{{--</x-mail::button>--}}

  @component('mail::panel')
      کد بازیابی رمز عبور   شما:{{$code}}
    @endcomponent

باتشکر,<br>
{{ config('app.name') }}
</x-mail::message>
