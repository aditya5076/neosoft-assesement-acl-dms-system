@component('mail::message')
# Welcome to Our Application

Hello {{ $name }},

Your account has been created with the following credentials:

Email: {{ $email }}
<br />
Password: {{ $password }}

@component('mail::button', ['url' => route('login')])
Login
@endcomponent

Thank you for joining us!

@endcomponent