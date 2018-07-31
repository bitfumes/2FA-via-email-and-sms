@component('mail::message')
# Introduction

Your OTP is {{ $OTP }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
