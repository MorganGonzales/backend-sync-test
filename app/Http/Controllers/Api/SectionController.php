<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return Section::all();
    }

    /**
     * Display the specified resource.
     *
     * @param Section $section
     * @return Section
     */
    public function show(Section $section)
    {
        return $section;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @todo Only moderators should be able to create sections
     * @param  \Illuminate\Http\Request $request
     * @return Section
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        return Section::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Section      $section
     * @return Section
     */
    public function update(Request $request, Section $section)
    {
        $section->update($request->all());

        return $section->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section $section
     * @throws \Exception
     */
    public function destroy(Section $section)
    {
        $section->delete();
    }
}
