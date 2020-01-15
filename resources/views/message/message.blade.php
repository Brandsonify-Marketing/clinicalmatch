                @forelse($messages as $message)
                @if($message->from == Auth::user()->id)
                <div class="message-detail-inset"> 
                    <div class="message-detail-img">
                        <div class="user-msg-img">
                         @if(!empty($user->profile->image))              
                            <img src="{{ url('storage/profile-image/'.$user->profile->image)}}"/>
                         @else              
                            <img src="{{ asset('images/default-user.jpg')}}"> 
                         @endif
                        </div>  
                    </div>
                    <div class="message-detail-txt">
                        <h4>{{auth()->user()->firstname}} {{auth()->user()->lastname}}</h4>
                        <p>{{$message->message}}</p>
                        @if($message->attachment)
                        <a href="{{asset('storage/message/'.$message->attachment)}}" target="_blank">
                            {{ $message->attachment}}
                        </a>    
                        @endif    
                        <!-- <a href="{{route('message.delete',$message->id)}}"> <i class="fa fa-trash"></i></a> -->
                        <!-- <input type="hidden" name="message-id" value="{{$message->id}}" id="message-id"> -->
                        <button class="deleteRecord" data-id="{{ $message->id }}" ><i class="fa fa-trash"></i></button>
                    </div>
                    <div class="message-detail-time">
                        <span>{{ Illuminate\Support\Carbon::parse($message->created_at)->format('H:s a')}}</span>
                    </div>
                </div>
                @else
                <div class="message-detail-inset">
                    <div class="message-detail-time">
                        <span>{{ Illuminate\Support\Carbon::parse($message->created_at)->format('H:s a')}}</span>
                    </div>
                    <div class="message-detail-txt">
                        <h4>{{$reciever->firstname}} {{$reciever->lastname}}</h4>
                        <p>{{$message->message}}</p>
                        @if($message->attachment)
                        <a href="{{asset('storage/message/'.$message->attachment)}}" target="_blank">
                            {{ $message->attachment}}
                        </a>    
                        @endif                     
                    </div>
                    <div class="message-detail-img">
                        <div class="user-msg-img">
                         @if(!empty($user->profile->image))              
                            <img src="{{ url('storage/profile-image/'.$user->profile->image)}}"/>
                         @else              
                            <img src="{{ asset('images/default-user.jpg')}}"> 
                         @endif
                        </div>  
                    </div>
                </div>
                @endif
                @empty
                <p><b>There are no messages yet!</b></p>
                @endforelse

<script>
$(".deleteRecord").click(function(){
var id = $(this).data('id');
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax(
    {
        url: "{{ url('message/destroy')}}"+'/'+id,
        type: 'delete',
        dataType: "JSON",
        data: {
            "id": id
        },
        success: function (response)
        {
            console.log(response);
        },
        error: function(xhr) {
         // console.log(xhr.responseText);
       }
    });
});
</script>