<?php

namespace App\Http\View\Composers;

use App\Models\Message;
use Illuminate\View\View;

class MessageComposer
{
    public function compose(View $view)
    {
        $messages = Message::unread()->orderByDesc('id')->get(['id', 'name', 'phone', 'created_at']);
        $view->with('messagesFromComposer', $messages);
    }
}
