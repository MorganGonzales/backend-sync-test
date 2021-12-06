<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return Message::all();
    }

    /**
     * Display the specified resource.
     *
     * @param Message $message
     * @return Message
     */
    public function show(Message $message)
    {
        return $message;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @todo Only return fields appropriate to profile
     * @param  \Illuminate\Http\Request $request
     * @return Message
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'topic_id' => 'required',
            'body' => 'required',
        ]);

        return Message::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @todo Only the owning user or a moderator should be able to update this resource.
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Message      $message
     * @return Message
     */
    public function update(Request $request, Message $message)
    {
        $message->update($request->all());

        return $message->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message $message
     * @throws \Exception
     */
    public function destroy(Message $message)
    {
        $message->delete();
    }
}
