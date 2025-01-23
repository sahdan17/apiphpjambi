<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function getMessage() {
        $msg = Message::all();

        if (count($msg) > 0) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil',
                'payload' => $msg,
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Kosong'
            ]);
        }
    }

    public function deleteMessage() {
        Message::truncate();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil Hapus Data',
        ]);
    }
}
