<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\operation;
use App\Models\doctor;
use App\Models\op_room;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operations = operation::all();
        $doctors = doctor::all();
        $op_rooms = op_room::all();
        return view('operations', compact('operations', 'doctors', 'op_rooms'));
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
            'dateTime' => 'required',
            'doctorSelector' => 'required',
            'op_roomSelector' => 'required',
        ]);
        $anesthesiologist_name = $request->doctorSelector;
        $anesthesiologist = doctor::where('name', '=', $anesthesiologist_name)->get();
        $operation = new operation;
        $operation->dateTime = $request->dateTime;
        $operation->anesthesiologist_Id = $anesthesiologist[0]->Id;
        $operation->op_room_Id = $request->op_roomSelector;
        $operation->save();
        return redirect('operations');
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
            'dateTime' => 'required',
            'doctorSelector' => 'required',
            'op_roomSelector' => 'required',
        ]);
        $anesthesiologist_name = $request->doctorSelector;
        $surgon = doctor::where('name', '=', $anesthesiologist_name)->get();
        operation::where('Id', '=', $id)->update([
            'dateTime' => $request->dateTime,
            'anesthesiologist_Id' => $request->doctorSelector,
            'op_room_Id' => $request->op_roomSelector,
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
        operation::where('Id', '=', $id)->delete();
        return redirect('operations');
    }
}
