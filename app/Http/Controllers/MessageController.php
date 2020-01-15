<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Conversation;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inbox() {
        $conversations = Conversation::orWhere('from', auth()->user()->id)
                ->orWhere('to', auth()->user()->id)->orderBy('id', 'DESC')
                ->get();
        return view('message.inbox', ['conversations' => $conversations]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request, $id) {
        $conversation_id = getConversationId($id);
        $messages = [];
        if (@$conversation_id) {
            Message::Where('to', auth()->user()->id)
                    ->Where('from', $id)
                    ->update(['read_at' => 1]);
            $messages = Message::where('conversation_id', $conversation_id)
                    ->get();
        }
        $reciever = User::where('id', $id)->first();
        return view('message.message', ['id' => $id, 'messages' => $messages, 'reciever' => $reciever]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chat(Request $request, $id) {
        $conversation_id = getConversationId($id);
        $messages = [];
        if (@$conversation_id) {
            Message::Where('to', auth()->user()->id)
                    ->Where('from', $id)
                    ->update(['read_at' => 1]);
            $messages = Message::where('conversation_id', $conversation_id)
                    ->get();
        }
        $reciever = User::where('id', $id)->first();
        return view('message.chat', ['id' => $id, 'messages' => $messages, 'reciever' => $reciever])->render();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unread() {
        $conversations = Conversation::orWhere('from', auth()->user()->id)
                ->orWhere('to', auth()->user()->id)->orderBy('id', 'DESC')
                ->get();
        return view('message.unread', ['conversations' => $conversations]);
    }

    public function trash() {
        $conversation_id = Conversation::orWhere('from', auth()->user()->id)
                ->orWhere('to', auth()->user()->id)->orderBy('id', 'DESC')
                ->pluck('id');
        $messages = Message::onlyTrashed()->where('from', auth()->user()->id)->whereIn('conversation_id', $conversation_id)->get();

        return view('message.trash', ['messages' => $messages]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id) {
        if($request->hasFile('attachment')) {        
            $filenameWithExt = $request->file('attachment')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
            $extension = $request->file('attachment')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.date('mdYHis').uniqid().'.'.$extension;                       
            $path = $request->file('attachment')->storeAs('public/message/',$fileNameToStore);
        } 
        else 
        {
            $fileNameToStore = '';
        }
        $conversation_id = getConversationId($id);
        if (!@$conversation_id) {
            $conversation = new Conversation;
            $conversation->to = $id;
            $conversation->from = auth()->user()->id;
            $conversation->save();
//            return response ()->json ( $conversation );
            $conversation_id = $conversation->id;
        }
        $message = new Message;
        $message->message = $request->message;
        $message->attachment = $fileNameToStore;
        $message->conversation_id = $conversation_id;
        $message->to = $id;
        $message->from = auth()->user()->id;
        $message->save();
        // return redirect()->back();
        return response ()->json($message);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
      $message = Message::withTrashed()->where('id', $id)->firstOrFail();
      $message->restore();
      return redirect()->back();
      // return response ()->json('success', 'Message Deleted Successfully');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message) {
        $message->delete();
        return response ()->json('success', 'Message Deleted Successfully');
    }
}
