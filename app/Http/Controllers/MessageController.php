<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:500',
        ]);

        $message = Message::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'content' => $request->message,
        ]);

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function getMessages(Request $request)
    {
        $senderId = $request->input('sender_id');
        $receiverId = $request->input('receiver_id');

        // Fetch messages between sender and receiver
        $messages = Message::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', $senderId);
        })->orderBy('created_at', 'asc')
        ->get();

        return response()->json($messages);
    }

    public function getUsersWithChats()
    {
        $currentUserId = auth()->id();

        // Fetch users who have sent or received messages with the current user
        // $users = User::whereHas('messages', function ($query) use ($currentUserId) {
        //     $query->where('sender_id', $currentUserId)
        //         ->orWhere('receiver_id', $currentUserId);
        // })
        $users = User::whereHas('sentMessages', function ($query) use ($currentUserId) {
            $query->where('receiver_id', $currentUserId);
        })
        ->orWhereHas('receivedMessages', function ($query) use ($currentUserId) {
            $query->where('sender_id', $currentUserId);
        })
        ->where('id', '!=', $currentUserId) // Exclude the current user
        ->get()
        ->map(function ($user) {
            $user->profile_photo = $user->profile_photo ? asset('uploads/profilephoto/' . $user->profile_photo) : asset('uploads/profilephoto/download (2).png');
            return $user;
        });

        return response()->json($users);
    }



}
