<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $patients  = Patient::with('hospital')
            ->when($request->hospital_id, function ($query) use ($request) {
                $query->where('hospital_id', $request->hospital_id);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
        $hospitals = Hospital::all();
        return view('patients.index', compact('patients', 'hospitals'));
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
        $request->validate([
            'name'        => 'required|string|max:255',
            'address'     => 'required|string',
            'phone'       => 'required|string|max:20',
            'hospital_id' => 'required|exists:hospitals,id',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $patient = Patient::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'address'     => 'required|string',
            'phone'       => 'required|string|max:20',
            'hospital_id' => 'required|exists:hospitals,id',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json(['success' => true]);
    }
}
