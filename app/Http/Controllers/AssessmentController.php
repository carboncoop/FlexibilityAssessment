<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::user()->role !== "administrator")
            $assessments = Auth::user()->assessments;
        else {
            $assessments = collect();
            foreach (Auth::user()->organisation->users as $user) {
                $assessments = $assessments->concat($user->assessments);
            }
        }


        return view('assessments.list', compact('assessments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:assessments|max:255',
            'description' => 'max:1000'
        ]);

        $assessment = new Assessment;
        $assessment->name = $request->name;
        $assessment->description = $request->description;
        $assessment->data = $request->data;
        $assessment['owner_id'] = Auth::user()->id;
        $assessment->save();

        return response($assessment, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $assessment = Assessment::findOrFail($id);

        if ($this->authorize('view', $assessment))
            return view('assessments.assessment', ['assessment' => $assessment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $assessment = Assessment::findOrFail($id);
        if (!$this->authorize('update', $assessment))
            abort(401, "You are not allowed to edit this assessment");

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:1000'
        ]);

        // Check if we are changing the name and already exist
        $assessment = Assessment::where('name', $request->name)->get()->first();
        if (is_null($assessment) == false) {
            if ($assessment->id != $request->id) {
                return response('Name already exists', 409);
            }
        }
        $assessment = Assessment::findOrFail($id);
        $assessment->name = $request->name;
        $assessment->description = $request->description;
        $assessment->data = $request->data;
        $assessment->save();
        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $assessment = Assessment::findOrFail($id);
        if (!$this->authorize('delete', $assessment))
            abort(401, "You are not allowed to delete this assessment");

        Assessment::destroy($id);

        return response(null, 200);
    }

}
