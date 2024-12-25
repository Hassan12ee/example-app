<?php

namespace App\Http\Controllers;


use App\Models\patient;
use Illuminate\Http\Request;



class patientcontroller extends Controller

{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients',
            'age' => 'required|integer',
            'glucose_level' => 'required|numeric',
            'date_recorded' => 'required|date',
        ]);

        Patient::create($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient record added successfully');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|integer',
            'glucose_level' => 'required|numeric',
            'date_recorded' => 'required|date',
        ]);

        $patient->update($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient record updated');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient record deleted');
    }
}
