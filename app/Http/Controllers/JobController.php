<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\property;
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

        return $user->id;
    }

    public function store(Request $request)
    {
        //  I had to change store method
        // because of user can send data from api as 'property' for 'property_id'
        // I have separated tables at the begging because I have added rest api after it.

        if ($request['status'] == '') {
            $request['status'] = 'open';
        }

        $main_property_id="";

        if($request['property']){

            //Check whether property exist or not

            $propery_checking = property::where('property_name',$request['property'])->count();

            if($propery_checking != 0 ){
                $propery_id = property::where('property_name',$request['property'])->get('id');
                    $main_property_id = $propery_id[0]->id;

            }else{
               $new_property= property::create(
                ['property_name' => $request['property'],]);
                $main_property_id =$new_property['id'];
            }

        }else{
            $main_property_id = $request['property_id'];
        }


        $request['user_id'] = $this->getActiveUser();
        $this->validate($request, [
            'summary' => 'required|string|max:150',
            'description' => 'required|string|max:500',
            'status' => 'required|string',
            'user_id' => 'required|numeric',

        ]);

        if(is_numeric($main_property_id)){
        $result = Job::create([
            'summary' => $request['summary'],
            'description' => $request['description'],
            'property_id' => $main_property_id,
            'status' => $request['status'],
            'user_id' => $this->getActiveUser(),
        ]);
            return response($result, 201);
        }



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
