<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\team;
use App\Models\doctor;
use App\Models\nurse;
use App\Models\team_doctor;
use App\Models\team_nurse;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = team::all();
        $doctors = doctor::all();
        $nurses = nurse::all();
        $team_doctor = team_doctor::all();
        $team_nurse = team_nurse::all();

        $teamDocs = [];
        $teamNurs = [];
        foreach ($team_doctor as $index => $doc) {
            $teamDocs[$index] = [
                doctor::where('Id', '=', $doc->doctor_Id)->get()[0],
                $doc->team_Id
            ];
        }
        foreach ($team_nurse as $index => $nur) {
            $teamNurs[$index] = [
                nurse::where('Id', '=', $nur->nurse_Id)->get()[0],
                $nur->team_Id
            ];
        }

        return view('teams', compact('teams', 'doctors', 'nurses', 'teamDocs', 'teamNurs'));
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
        $this->validate($request, [
            'doctorSelector' => 'required',
            'nurseSelector' => 'required'
        ]);
        $team = team::create()->get();

        $selectedDoctors = $request->doctorSelector;
        $selectedNurses = $request->nurseSelector;
        foreach ($selectedDoctors as $selectedDoctor) {
            $team_doc = new team_doctor;
            $doc = new doctor;
            $doc = doctor::where('name', '=', $selectedDoctor)->get();
            $team_doc->doctor_Id = $doc[0]->Id;
            $team_doc->team_Id = $team[count($team) - 1]->Id;
            $team_doc->save();
        }
        foreach ($selectedNurses as $selectedNurse) {
            $team_nur = new team_nurse;
            $nur = new nurse;
            $nur = nurse::where('name', '=', $selectedNurse)->get();
            $team_nur->nurse_Id = $nur[0]->Id;
            $team_nur->team_Id = $team[count($team) - 1]->Id;
            $team_nur->save();
        }
        return redirect('/teams');
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
    public function update(Request $request, team $team)
    {
        error_log($request->editDoctorSelector);
        $this->validate($request, [
            'doctorSelector' => 'required'
        ]);
        team_doctor::where('team_Id', '=', $team->Id)->delete();
        team_nurse::where('team_Id', '=', $team->Id)->delete();
        $selectedDoctors = $request->editDoctorSelector;
        $selectedNurses = $request->editNurseSelector;
        foreach ($selectedDoctors as $selectedDoctor) {
            $team_doc = new team_doctor;
            $doc = new doctor;
            $doc = doctor::where('name', '=', $selectedDoctor)->get();
            $team_doc->doctor_Id = $doc[0]->Id;
            $team_doc->team_Id = $team->Id;
            $team_doc->save();
        }
        foreach ($selectedNurses as $selectedNurse) {
            $team_nur = new team_nurse;
            $nur = new nurse;
            $nur = nurse::where('name', '=', $selectedNurse)->get();
            $team_nur->nurse_Id = $nur[0]->Id;
            $team_nur->team_Id = $team->Id;
            $team_nur->save();
        }
        return redirect('/teams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(team $team)
    {
        team_doctor::where('team_Id', '=', $team->Id)->delete();
        team_nurse::where('team_Id', '=', $team->Id)->delete();
        team::where('Id', '=', $team->Id)->delete();
        return redirect('/teams');
    }
}
