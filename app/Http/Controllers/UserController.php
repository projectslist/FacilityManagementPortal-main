<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=Auth::user();
        return User::where('email',$user->email)->get();

    }

    public function getUserToken(){
        $user=Auth::user();

        \DB::table('personal_access_tokens')
            ->where('personal_access_tokens.tokenable_id',$user->id)
            ->delete();

        $token = $user->createToken('appToken')->plainTextToken;

        return $token;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = auth()->user();

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6'
        ]);



        $currentPhoto = $user->profile_image;

        if($request->profile_image != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->profile_image, 0, strpos($request->profile_image, ';')))[1])[1];

            \Image::make($request->profile_image)->save(public_path('img/').$name);
            $request->merge(['profile_image' => $name]);

            $userPhoto = public_path('img/').$currentPhoto;
            if($currentPhoto != 'default_profile.png'){
                if(file_exists($userPhoto)){

                    @unlink($userPhoto);
                }

            }

        }

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }


        $user->update($request->all());


        $message= ["message" => "Your profile has been updated!"];
        return request()->json(200,$message);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
