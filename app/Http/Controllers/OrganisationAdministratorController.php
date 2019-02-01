<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $assessments = collect();
        foreach (Auth::user()->organisation->users as $user) {
            $assessments = $assessments->concat($user->assessments);
        }

        foreach ($assessments as $assessment){
            $assessment->owner_name = $assessment->user->name;
        }
        
        return view('organisationAdministrator.dashboard', compact('assessments'));
    }

}

