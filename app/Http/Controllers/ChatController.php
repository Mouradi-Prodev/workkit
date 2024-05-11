<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
    public function getMessages(ChatRoom $chatroom)
    {
        //get chat room by id  
        //    $chatRoom=auth()->user()->chat_rooms->where('id','=',$id)->first(); 

        if ($chatroom) {
            //return all message from this chatroom with user who sent it and the time
            $messages = $chatroom->messages;
            foreach ($messages as $message) {
                $message->user = $message->user->name;
            };
            return Inertia::render('Chat/View', [
                'messages' => $messages
            ]);
        } else {
            abort(403, "This isn't your Chat Room");
        }
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
        //
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
