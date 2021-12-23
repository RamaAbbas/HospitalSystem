<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\examination;
use App\Models\doc_exam;
use App\Models\doctor;

class DocExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examinations = examination::all();
        $doc_exams = doc_exam::all();
        $doctors = doctor::all();
        return view('doc_exams', compact('doc_exams', 'doctors', 'examinations'));
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
            'examSelector' => 'required',
            'result' => 'required'
        ]);
        $doctor = doctor::where('name', '=', $request->doctorSelector)->get();
        $examination = examination::where('Id', '=', $request->examSelector)->get();
        $doc_exam = new doc_exam;
        $doc_exam->result = $request->result;
        $doc_exam->doctor_Id = $doctor[0]->Id;
        $doc_exam->examination_Id = $examination[0]->Id;
        $doc_exam->save();
        return redirect('/doc_exams');
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
        error_log($request->doctorSelector);
        $this->validate($request, [
            'doctorSelector' => 'required',
            'examSelector' => 'required',
            'result' => 'required'
        ]);
        doc_exam::where('Id', '=', $id)->update([
            'result' => $request->result,
            'doctor_Id' => $request->doctorSelector,
            'examination_Id' => $request->examSelector
        ]);
        return redirect('/doc_exams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        doc_exam::where('Id', '=', $id)->delete();
        return redirect('/doc_exams');
    }
}
