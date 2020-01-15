@extends('layouts.dashboard-menu')
@section('content')
<div class="page-container">
    <div class="dashbrd-section">
        <div class="page-title-hdng">
            <h1>Message Center</h1>
        </div>
        <div class="message-sidebar d-md-none">
            <div class="fav-message">
                <h3>Favorite Messages</h3>
                <div class="message-search-bar">
                    <input type="search" placeholder="Search..." name="">
                </div>
            </div>
            <div class="people-message">
                <h3>People</h3>
                <div class="user-messages">
                    <div class="user-messages-inner">
                        <div class="user-mes-img">
                            <img src="images/user-img.jpg">
                        </div>
                        <div class="user-mes-txt">
                            <h4>James Smith</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesett</p>
                        </div>
                    </div>
                    <div class="user-messages-inner">
                        <div class="user-mes-img">
                            <img src="images/user-img.jpg">
                        </div>
                        <div class="user-mes-txt">
                            <h4>James Smith</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesett</p>
                        </div>
                    </div>
                    <div class="user-messages-inner">
                        <div class="user-mes-img">
                            <img src="images/user-img.jpg">
                        </div>
                        <div class="user-mes-txt">
                            <h4>James Smith</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesett</p>
                        </div>
                    </div>
                    <div class="user-messages-inner">
                        <div class="user-mes-img">
                            <img src="images/user-img.jpg">
                        </div>
                        <div class="user-mes-txt">
                            <h4>James Smith</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesett</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-messase-right d-md-block">
            <div class="message-head">
            </div>
            <div class="message-details">
                @forelse($conversations as $conversation)
                <?php
                $message = App\Message::where('conversation_id', $conversation->id)->whereNull('deleted_at')->orderBy('id', 'DESC')->first();
                if(is_null($message))
                {
                    $message = '';
                }   
                else
                {
                if ($message->from == Auth::user()->id) {
                    $reciever = App\User::where('id', $message->to)->first();
                    ?>
                    <div class="message-detail-inset {{ ($message->read_at==1) ? "read" :"unread" }}">
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
                            {{ ($message->read_at==1) ? "read" :"unread" }}<a href="{{route('message.chat',$reciever->id)}}"><h4>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h4></a>
                            <p>{{$message->message}}</p>
                             @if($message->attachment)
                                <a href="{{asset('storage/message/'.$message->attachment)}}" target="_blank">
                                    {{ $message->attachment}}
                            @endif    
                        </div>
                        <div class="message-detail-time">
                            <span>{{ Illuminate\Support\Carbon::parse($message->created_at)->format('H:s a')}}</span>
                        </div>
                    </div>
                    <?php
                } else {
                    $reciever = App\User::where('id', $message->from)->first();
                    ?>
                    <div class="message-detail-inset {{ ($message->read_at==1) ? "read" :"unread" }}">
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
                            {{ ($message->read_at==1) ? "read" :"unread" }}<a href="{{route('message.chat',$reciever->id)}}"><h4>{{$reciever->firstname}} {{$reciever->lastname}}</h4></a>
                               <p> {{$message->message}}</p>
                            @if($message->attachment)
                            <a href="{{asset('storage/message/'.$message->attachment)}}" target="_blank">
                                {{ $message->attachment}}
                            @endif    
                        </div>
                        <div class="message-detail-time">
                            <span>{{ Illuminate\Support\Carbon::parse($message->created_at)->format('H:s a')}}</span>
                        </div>
                    </div>
                    <?php
                }
                 }
                ?>
                @empty
                <p><b>No message available</b></p>
                @endforelse

            </div>  
        </div>
    </div>  
    <div class="copy-right">
        <p>2019 Copyright © <a href="#">Clinical Match</a></p>
    </div>      
</div>
@endsection
