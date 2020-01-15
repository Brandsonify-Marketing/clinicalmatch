<?php

use App\Conversation;

function getConversationId($id) {
    $conversation = Conversation::where('to', $id)
                    ->where('from', auth()->user()->id)->first();
    if (@$conversation) {
        $conversation_id = $conversation->id;
    }
    if (!@$conversation_id) {
        $conversation = Conversation::where('from', $id)
                        ->where('to', auth()->user()->id)->first();
        if (@$conversation) {
            $conversation_id = $conversation->id;
        }
    }
    if (@$conversation_id) {
        return $conversation_id;
    } else {
        return 0;
    }
}
