@component('vendor.mail.html.message')
    **Click this button to log in**
@component('vendor.mail.html.button', ['url' => $url, 'color'=>'green'])
     LOG IN
@endcomponent
    If the button doesn’t work, copy and paste this URL into your browser:

    {{$url}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
