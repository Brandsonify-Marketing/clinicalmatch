@component('mail::message')

{{ ucfirst($contact->name)}} has Contacted.

@component('mail::table')

|        |            |
| ------------- |-------------:|
| Name     | {{ $contact->name }}    | 
| Email      | {{ $contact->email }}    |
| Phone      | {{ $contact->phone }}    |
| Category      | {{ $contact->category }}    |
| Marketing      | {{ $contact->marketing }}    |
| Message      | {{ $contact->message }}    |
@endcomponent

<br>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
