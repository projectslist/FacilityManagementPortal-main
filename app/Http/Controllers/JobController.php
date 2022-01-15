<?php

namespace App\Http\Controllers;

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


        return \DB::table('jobs')
            ->select('users.name', 'properties.property_name',
                'jobs.id', 'jobs.summary', 'jobs.description', 'jobs.status'
                , 'jobs.property_id')
            ->join('properties', 'jobs.property_id', '=', 'properties.id')
            ->join('users', 'jobs.user_id', '=', 'users.id')
            ->orderBy('jobs.id', 'DESC')->paginate(10);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function getActiveUser()
    {
        $user = Auth::user();
        return 2;
        return $user->id;
    }

    public function store(Request $request)
    {
        //


        if ($request['status'] == '') {
            $request['status'] = 'open';
        }
        $request['user_id'] = $this->getActiveUser();
        $this->validate($request, [
            'summary' => 'required|string|max:150',
            'description' => 'required|string|max:500',
            'property_id' => 'required|numeric',
            'status' => 'required|string',
            'user_id' => 'required|numeric',

        ]);


        $result = Job::create([
            'summary' => $request['summary'],
            'description' => $request['description'],
            'property_id' => $request['property_id'],
            'status' => $request['status'],
            'user_id' => $this->getActiveUser(),
        ]);

        return response($result, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Job::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $job = Job::findorFail($id);
        $request['user_id'] = $this->getActiveUser();
        $this->validate($request, [
            'summary' => 'required|string|max:150',
            'description' => 'required|string|max:500',
            'property_id' => 'required | numeric',
            'status' => 'required|string',
            'user_id' => 'required | numeric',

        ]);

        return $job->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $job = Job::findorFail($id);
        return $job->delete();
    }
}
