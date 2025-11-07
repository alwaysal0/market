@component('mail::message')
# Новое сообщение с формы

**Имя:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}

---

{{ $data['message'] }}

@endcomponent
