<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Message;
use App\Models\ChatRoom;
use App\Jobs\SendMessage;
use App\Events\MessageSent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\MessageCreated;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ChatRoomRequest;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $chatRooms = auth()->user()->chat_rooms;
        return Inertia::render('Chat/View', [
            'chatRooms' => $chatRooms
        ]);
    }

    /**
     * return messages of the specified chartroom
     */
    public function getMessages(Request $request, $id)
    {
        $chatroom = ChatRoom::find($id);
        Gate::authorize('view', $chatroom);

        $messages = $chatroom->messages;
        foreach ($messages as $message) {
            $message->user = $message->user;
        };

        return Inertia::render('Chat/View', [
            'messages' => $messages,
            'chatRooms' => auth()->user()->chat_rooms,
            'selectedRoomId' => $chatroom->id
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //who ever can see the chatroom can send a message in it : 
        $chatroom = ChatRoom::find($request['chat_room_id']);
        Gate::authorize('view', $chatroom);


        $message = new Message(['content' => $request['content']]);
        $message->user_id = auth()->user()->id;
        $message = $chatroom->messages()->save($message);
        $message->user = $message->user->name;
        MessageCreated::dispatch($message);
        return $message;

        // broadcast(new MessageCreated($message))->toOthers();
    }

    public function createChatRoom(ChatRoomRequest $request)
    {
        $slug = Str::slug($request->name);
        $user = $request->user();
        $chatRoom = new ChatRoom();
        $chatRoom->name = $request->name;
        $chatRoom->slug = $slug;
        $chatRoom->user_id = $user->id;
        $chatRoom->save();
        $chatRoom->users()->attach($user);
        //$user->chat_rooms()->attach($chatRoom); second method
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
