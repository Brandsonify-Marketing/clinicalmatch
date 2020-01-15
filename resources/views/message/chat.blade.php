@extends('layouts.dashboard-menu')
@section('content')
<div class="page-container">
    <div class="dashbrd-section">
       
        <div class="message-sidebar d-md-none">
            <!--            <div class="fav-message">
                            <h3>Favorite Messages</h3>
                            <div class="message-search-bar">
                                <input type="search" placeholder="Search..." name="">
                            </div>
                        </div>-->
            <div class="people-message">
                <h3>People</h3>
                <div class="user-messages">
                    <?php $users = App\User::get(); ?>
                    @foreach($users as $user)
                    <div class="user-messages-inner">
                        <div class="user-mes-img">
                         @if(!empty($user->profile->image))              
                            <img src="{{ url('storage/profile-image/'.$user->profile->image)}}"/>
                         @else              
                            <img src="{{ asset('images/default-user.jpg')}}"> 
                         @endif
                        </div>
                        <div class="user-mes-txt">
                            <a href="{{route('message.chat',$user->id)}}"><h4>{{$user->firstname}} {{$user->lastname}}</h4></a>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesett</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="user-messase-right d-md-block">
            <div class="message-head">
                <h3>{{$reciever->firstname}} {{$reciever->lastname}} <span>{{ \Carbon\Carbon::now()->toTimeString() }}</span></h3>
            </div>
            <div class="message-detail">
                <div class="message-date">
                    <h3>{{  date("F j, Y") }}</h3>
                </div>
             <div id="message_details">
             </div>
                <form action="{{route('message.create',$id)}}" id="upload_form" method="Post" enctype="multipart/form-data">
                    @csrf
                    <div class="message-user-search">
                        <div class="upload-attachment">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                        <input type="file" name="attachment" id="attachment">
                        </div>
                        <div class="input-message">
                            <textarea name="message"></textarea>
                            <input type="hidden" name="id" value="{{request()->route('id')}}" id="user_id_message">
                            <input type="submit" name="upload" id="upload" value="Send">
<!--                             <button class="btn btn-primary" type="submit" id="add">
                                <span class="glyphicon glyphicon-plus"></span> Send
                            </button> -->
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>  
    <div class="copy-right">
        <p>2019 Copyright © <a href="#">Clinical Match</a></p>
    </div>      
</div>
@endsection
@section('scripts')
<!-- <script>

var user_id = $("#user_id_message").val();
$("#add").click(function() {
$.ajax({
        type: 'post',
        url: "{{ url('message/create')}}"+'/'+user_id,
        data: {
            '_token': $('input[name=_token]').val(),
            'message': $('textarea[name="message"]').val()
        },
        success: function(data) {
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                $('.error').text(data.errors.message);
            } else {
                $('.error').remove();
                // $('#message_details').append(data.message);
                $('#message_details').append(data);
            }
        },
    });
});
    setInterval(function(){
        $(document).ready(function() {
        $.ajax({
        type: 'get',
        url: "{{ url('message/view')}}"+'/'+user_id,
        success: function(data) {
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                $('.error').text(data.errors.message);
            } else {
                $('.error').remove();
                // $('#message_details').append(data.message);
                $('#message_details').html(data);
                // $('#message_details').append(data);
            }
        },
    });    
    });
    },1000);
</script> -->
<script>
var user_id = $("#user_id_message").val();
$(document).ready(function(){
$('#upload_form').on('submit', function(event){
    event.preventDefault();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
  	});
    $.ajax({
    url: "{{ url('message/create')}}"+'/'+user_id,
    method:"POST",
    data:new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success:function(data)
    {
        $('#message_details').append(data);
        // $('#message_details').append(data.attachment);
    }
    })
    document.getElementById("upload_form").reset();
    });
    });
setInterval(function(){
    $(document).ready(function() {
    $.ajax({
    type: 'get',
    url: "{{ url('message/view')}}"+'/'+user_id,
    success: function(data) {
        if ((data.errors)) {
            $('.error').removeClass('hidden');
            $('.error').text(data.errors.message);
        } else {
            $('.error').remove();
            // $('#message_details').append(data.message);
            $('#message_details').html(data);
        }
    },
    });    
    });
    },1000);
</script>
@endsection

