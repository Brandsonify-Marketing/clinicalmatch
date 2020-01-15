<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--CSRF Token--> 
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Clinical Match') }}</title>
                <link rel="icon" href="{{ asset('images/fav.jpg') }}" type="image/png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('fonts/stylesheet.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
        @yield('extra-css')

    </head>
    <body>
            @include('partials.header')
            <main class="page-body">
                @yield('content')
            </main>
            @include('partials.footer')
            <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
            <script type="text/javascript" src="js/owl.carousel.min.js"></script>
            <script type="text/javascript" src="js/wow.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script>
            new WOW().init();
            </script>
            @yield('extra-js')
            <script src="{{ asset('js/custom.js') }}"></script>
            <script type="text/javascript">
$(document).ready(function () {
    $("#subscribeForm").submit(function (e) {
        $(".btn-subscribe").prop("disabled", true);

        e.preventDefault();
        $('.errors_div').remove();
        var csrf = $("input[name=_token]").val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': csrf},
            type: 'POST',
            url: "{{ route('subscriber.store') }}",
            data: {
                'first_name': $("#sub_first_name").val(),
                'last_name': $("#sub_last_name").val(),
                'email': $("#sub_email").val(),
            },
            success: function (response) {
                $(".subscribeSec").hide();
                $(".thanksSec").show();
            },
            error: function (jqXHR, exception) {
                var obj = jQuery.parseJSON(jqXHR.responseText);
                $('.errors_subscribe_div').show();
                $.each(obj.errors, function (key, value) {

                    $('.errors_subscribe').append('<li class="errors_div">' + value + '</li>');
                });
                $(".btn-subscribe").prop("disabled", false);
            },

        });
    });
});
</script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
  <script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img class="center-block" src="{{ url('/') }}/images/ajax-loader.gif" alt="Loading..." />',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>
    </body>
</html>
