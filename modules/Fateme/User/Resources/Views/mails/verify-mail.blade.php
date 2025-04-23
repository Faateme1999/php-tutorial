<x-mail::message>
# کد فعال سازی حساب شما در tutorial

این ایمیل بخاطر ثبت نامت ارسال شده!

{{--<x-mail::button :url="''">--}}
{{--Button Text--}}
{{--</x-mail::button>--}}

  @component('mail::panel')
      کدفعال سازی شما:{{$code}}
    @endcomponent

باتشکر,<br>
{{ config('app.name') }}
</x-mail::message>
