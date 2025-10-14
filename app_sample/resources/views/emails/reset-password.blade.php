@component('mail::message')
@php($logoPath = public_path('logoo.png'))
@if (is_file($logoPath))
<p style="text-align:center;margin-bottom:24px;">
    <img src="{{ $message->embed($logoPath) }}" alt="FarmGuide Logo" style="max-width:140px;height:auto;">
</p>
@endif

# {{ __('Hello from FarmGuide!') }}

{{ __('We received a request to reset the password for your FarmGuide account.') }}

@component('mail::button', ['url' => $url])
{{ __('Reset Password') }}
@endcomponent

{{ __('This password reset link will expire in :count minutes.', ['count' => $count]) }}

{{ __('If you did not request a password reset, you can safely ignore this email.') }}

{{ __('Regards,') }}<br>
{{ __('FarmGuide Team') }}
@endcomponent
