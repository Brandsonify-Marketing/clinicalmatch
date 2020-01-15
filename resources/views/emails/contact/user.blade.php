@component('mail::message')

Hello, {{ $contact->name}} {{ $contact->name }}
<br><br>
We’ve received your message and are looking forward to connecting with you. We’re committed to providing excellent service and answering any questions you may have.<br>One of our team members will be in touch shortly.
 <br><br>
Many Thanks,<br>
{{ config('app.name') }}
@endcomponent
