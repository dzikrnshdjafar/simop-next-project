<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use Illuminate\Support\Facades\URL;

class MessageController extends Controller
{

    public function store(StoreMessageRequest $request)
    {
        try {
            Message::create([
                'content' => $request->content,
                'activity_id' => $request->activity_id,
                'user_id' => auth()->user()->id
            ]);

            return redirect()->to(URL::previous() . "#message")->with('success', 'Pesan berhasil dikirim.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
