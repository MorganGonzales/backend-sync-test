<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return Topic::all();
    }

    /**
     * Display the specified resource.
     *
     * @param Topic $topic
     * @return Topic
     */
    public function show(Topic $topic)
    {
        return $topic;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @todo We should probably flag new topics for approval.
     * @param  \Illuminate\Http\Request $request
     * @return Topic
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        return Topic::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @todo Only the owning user or a moderator should be able to update this resource.
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Topic        $topic
     * @return Topic
     */
    public function update(Request $request, Topic $topic)
    {
        $topic->update($request->all());

        return $topic->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic $topic
     * @throws \Exception
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
    }
}
