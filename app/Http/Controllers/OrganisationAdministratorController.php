<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;

class OrganisationAdministratorController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    /**
     * Display the dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard() {

        $users = Auth::user()->organisation->users;

        $assessments = collect();
        foreach ($users as $user) {
            $assessments = $assessments->concat($user->assessments);
        }

        foreach ($assessments as $assessment) {
            $assessment->owner_name = $assessment->user->name;
        }

        return view('organisationAdministrator.dashboard', compact('assessments', 'users'));
    }

    /**
     * Creates a new user and adds it to the organisation 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createAddUser(Request $request) {

        $this->authorize('create', User::class);
        $validationErrorMessages = [
            'required' => "The :attribute field is required.",
            'unique' => "The :attribute already exist.",
            'min' => "The :attribute must be longer than :min.",
            'in' => 'The :attribute must be one of the following types: :values'
        ];

        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', 'string', Rule::in(['administrator', 'assessor', 'invited'])]
        ];

        $request->validate($rules, $validationErrorMessages);


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request['password']);
        $user->organisation_id = Auth::user()->organisation_id;
        $user->save();

        return response($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id) {

        $user = User::findOrFail($id);

        $this->authorize('delete', $user);

        User::destroy($id);

        return response(null, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id) {
        
        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        // Check if we are changing the name and already exist
        $user = User::where('name', $request->name)->get()->first();
        if (is_null($user) == false) {
            if ($user->id != $request->id) {
                return response('Name already exists', 409);
            }
        }
        // Check if we are changing the name and already exist
        $user = User::where('email', $request->email)->get()->first();
        if (is_null($user) == false) {
            if ($user->id != $request->id) {
                return response('Name already exists', 409);
            }
        }        
        
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
        return response(null, 200);
    }

}
