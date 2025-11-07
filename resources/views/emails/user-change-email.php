@component('mail::message')
# Change Your Email

Hello!

You requested a email changing.  
Follow the link below to set the new email:

@component('mail::panel')
{{ $link }}
@endcomponent

If you did not request this, you can safely ignore this email.

With respect,  
**Market Team**
@endcomponent
