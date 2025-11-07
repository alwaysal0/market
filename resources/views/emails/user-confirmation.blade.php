@component('mail::message')
# Confirm Your Email

Hello!

Please click the button below to confirm your email address:

@component('mail::button', ['url' => $link])
Confirm Email
@endcomponent

If you did not request this, you can safely ignore this email.

Thanks,
**Market Team**
@endcomponent
