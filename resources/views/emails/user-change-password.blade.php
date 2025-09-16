@component('mail::message')
# Reset Your Password

Hello!

You requested a password reset.  
Use the code below to set a new password:

@component('mail::panel')
{{ $code }}
@endcomponent

If you did not request this, you can safely ignore this email.

With respect,  
**Market Team**
@endcomponent
