<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Hire;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Job $job)
    {
        return view('user.hire.add', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Job $job)
    {
        $request->validate([
            'cv' => 'required|file',
        ]);

        $file = $request->file('cv');
        $name = time() . '-' . uniqid() . '.' . $file->extension();
        $file->storeAs('files', $name, 'public');
        $media = Media::create([
            'name' => $file->getClientOriginalName(),
            'url' => asset('storage/files/' . $name),
            'type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        Hire::create([
            'cv_id' => $media->id,
            'user_id' => Auth::user()->id,
            'job_id' => $job->id,
        ]);

        return to_route('job');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function show(Hire $hire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function edit(Hire $hire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hire $hire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hire $hire)
    {
        //
    }
}
