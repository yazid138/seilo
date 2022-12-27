<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hire;
use App\Models\Job;
use App\Models\Media;
use Illuminate\Http\Request;
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
        $user = Auth::user();
        $hires;
        switch ($user->role) {
            case 'COMPANY':
                $job = Job::where('company_id', $user->company[0]->id)->get();
                $jobId = array_map(function ($v) {
                    return $v['id'];
                }, $job->toArray());
                $hires = Hire::whereIn('job_id', $jobId)->get();
                break;
            case 'USER':
                $hires = Hire::where('user_id', $user->id)->get();
                break;
        }
        return view('jobStatus', compact('hires'));

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
            'company_id' => $job->company->id,
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
    public function show(Request $request, Hire $hire)
    {
        switch (Auth::user()->role) {
            case 'COMPANY':
                $user = $hire->user;
                return view('hireShow', compact('user', 'hire'));

            default:
                $user = Auth::user();
                return view('hireShowUser', compact('user', 'hire'));
        }
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
        $hire->update([
            'isApprove' => $request->isApprove,
        ]);

        return to_route('hire');
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
