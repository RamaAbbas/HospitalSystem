<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\op_room;
use App\Models\doctor;
use App\Models\team;

class OpRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $op_rooms = op_room::all();
        $doctors = doctor::all();
        $teams = team::all();
        return view('OpRooms', compact('op_rooms', 'doctors', 'teams'));
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
            'type' => 'required',
            'doctorSelector' => 'required',
            'teamSelector' => 'required',
            'open_at' => 'required',
            'close_at' => 'required'
        ]);
        $surgon_name = $request->doctorSelector;
        $surgon = doctor::where('name', '=', $surgon_name)->get();
        $op_room = new op_room;
        $op_room->type = $request->type;
        $op_room->surgeon_Id = $surgon[0]->Id;
        $op_room->team_Id = $request->teamSelector;
        $op_room->open_at = $request->open_at;
        $op_room->close_at = $request->close_at;
        $op_room->save();
        return redirect('opRooms');
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
        $this->validate($request, [
            'type' => 'required',
            'doctorSelector' => 'required',
            'teamSelector' => 'required',
            'open_at' => 'required',
            'close_at' => 'required'
        ]);
        $surgon_name = $request->doctorSelector;
        $surgon = doctor::where('name', '=', $surgon_name)->get();
        op_room::where('Id', '=', $id)->update([
            'type' => $request->type,
            'surgeon_Id' => $request->doctorSelector,
            'team_Id' => $request->teamSelector,
            'open_at' => $request->open_at,
            'close_at' => $request->close_at

        ]);
        return redirect('opRooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        error_log($id);
        op_room::where('Id', '=', $id)->delete();
        return redirect('opRooms');
    }
}
