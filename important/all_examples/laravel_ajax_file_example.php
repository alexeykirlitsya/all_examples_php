<?php

/*
 * 1. <script src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
 * 2.  <meta name="_token" content="{{csrf_token()}}" />
 * 3.  $(document).ready(function(){
        $('#nameButton').click(function(e){
            // e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('') }}",
                method: 'post',
                data: {
                    title: $('#title').val(),
                    text: $('#text').val()
                },
                success: function(result){

                }});
            $().redirect('{{route('index')}}');
        });
    });
 */