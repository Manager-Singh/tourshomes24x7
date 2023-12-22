@component('mail::message')
# A Heading

{{$message}}

- Name: {{$name}}
- Phone: {{$phone}}

@component('mail::button',['url' => 'https://laracasts.com'])
    Visit Laracasts
@endcomponent
@endcomponent