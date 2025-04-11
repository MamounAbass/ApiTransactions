<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\HASH;
use App\Models\User;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index( )
    {
       $users = User::all();
      
       //return response()->json(['data'=>$users],200);

      // By Using showAll method that use ApiResponser we created in Trait
      return $this->showAll($users);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ];
       
        $this->validate($request,$rules);

        $data = $request->all();
      
        $data['password'] = HASH::MAKE($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerifiactioncode();
        $data['admin'] = User::REGULAR_USER;

        $user =User::create($data);

        return response()->json(['data'=>$user],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrfail($id);

        //return response()->json(['data'=>$user],200);
        
       // By Using showOne method that use ApiResponser we created in Trait   
        return $this->showOne($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrfail($id);
        
        $rules =[
            'email'=>'required|eamil|unique:users,email'.$user->id,
            'password'=>'required|min:6|confirmed',
            'admin'=>'in:'.User::ADMIN_USER.','.User::REGULAR_USER,
        ];
         $this->validate($request,$rules);
        
        if($request->has('name'))
        {
            $user->name = $request->name;
        }

        if($request->has('email') && $user->email != $request->email)
        {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerifiactioncode();
            $user->email = $request->email;
        }
        if($request->has('password'))
        {
            $user->password = HASH::Make($request->password);
        }
        //
        // I need more time in this code 
        if($request->has('admin'))
        {
            if(!$user->isVerified()){

                return response()->json(['error'=>'Oly verified user can modfiy the admin field','code'=>409],409);
            }

            $user->admin = $request->admin;
        }
        //
        if(!$user->isDirty())
        {
            //return response()->json(['error'=> 'you need to specifiy diffirent value to updata','code'=>422],422);

            // By Using errorResponse method that use ApiResponser we created in Trait   
            return $this->errorResponse(' you need to specifiy different value to update ',422);
        }

        $user->save();
        return response()->json(['data'=>$user],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user =User::findOrfail($id);
        $user->delete();
        return response()->json(['data'=>$user],200);
    }
}
