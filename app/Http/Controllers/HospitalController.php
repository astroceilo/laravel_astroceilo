<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::orderBy('id', 'desc')->paginate(10);
        return view('hospitals.index', compact('hospitals'));
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
            'name'    => 'required|string|max:255',
            'address' => 'required|string',
            'email'   => 'required|email|unique:hospitals,email',
            'phone'   => 'required|string|max:20',
        ]);

        Hospital::create($request->all());

        return redirect()->route('hospitals.index')->with('success', 'Rumah Sakit berhasil ditambahkan.');
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
        $hospital = Hospital::findOrFail($id);

        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string',
            'email'   => 'required|email|unique:hospitals,email,' . $hospital->id,
            'phone'   => 'required|string|max:20',
        ]);

        $hospital->update($request->all());

        return redirect()->route('hospitals.index')->with('success', 'Rumah Sakit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();

        $currentPage = request()->get('page', 1);
        $paginator   = Hospital::paginate(10, ['*'], 'page', $currentPage);

        return response()->json([
            'success'     => true,
            'currentPage' => $currentPage,
            'lastPage'    => $paginator->lastPage(),
            'empty'       => $paginator->isEmpty()
        ]);
    }
}
