<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function getMessage() {
        $msg = Message::all();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil',
            'payload' => $msg,
        ]);
    }

    public function deleteMessage() {
        Message::truncate();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil',
        ]);
    }
}
