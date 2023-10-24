@component('mail::message')
# Welcome to Our Application

Hello {{ $firstName }},

Your account has been modifies with the following details:

First Name : {{ $firstName }} <br />
Last Name : {{ $lastName }} <br />

Email: {{ $email }}
<br />

@component('mail::button', ['url' => route('login')])
Login
@endcomponent

Thank you for joining us!

@endcomponent