<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nurse;

class NurseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nurses = nurse::all();
        return view('nurses', compact('nurses'));
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
    public function store(Request $req)
    {
        $this->validate($req, ['name' => 'required']);
        $doc = new nurse;
        $doc->name = $req->input('name');
        $doc->save();
        return redirect('/nurses');
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
    public function update(Request $req, nurse $nurse)
    {
        $this->validate($req, ['name' => 'required']);
        nurse::whereId($nurse->Id)->update(['name' => $req->name]);
        return redirect('/nurses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(nurse $nurse)
    {
        nurse::where('Id', '=', $nurse->Id)->delete();
        return redirect('/nurses');
    }
}
