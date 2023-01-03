<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobCreateRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();
        if (Auth::check()) {
            if (Auth::user()->role === 'COMPANY') {
                $jobs = Auth::user()->company[0]->jobs;
                return view('company.job.index', compact('jobs'));
            } else {
                return view('job', compact('jobs'));
            }
        } else {
            return view('job2', compact('jobs'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobCreateRequest $request)
    {
        $company = Auth::user()->company[0];
        $data = $request->toArray();
        $data['company_id'] = $company->id;
        Job::create($data);
        return to_route('job');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'COMPANY') {
                return view('company.job.show', compact('job'));
            } else {
                $pernahLamar = false;
                foreach (Auth::user()->hires as $hire) {
                    if ($hire->job->id === $job->id) {
                        $pernahLamar = true;
                        break;
                    }
                }
                return view('jobShow', compact('job', 'pernahLamar'));
            }
        } else {
            return view('jobShow2', compact('job'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(JobCreateRequest $request, Job $job)
    {
        $job->update($request->toArray());
        return to_route('job');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
