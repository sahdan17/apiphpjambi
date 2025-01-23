<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function getMessage() {
        $msg = Message::all();

        if ($msg->isNotEmpty()) {
            Message::whereIn('id', $msg->pluck('id'))->delete();

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
