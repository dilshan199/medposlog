<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinic = DB::table('clinic')
        ->select('*')
        ->orderBy('clinic_followup', 'asc')
        ->paginate(50);

        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data = $user;
        }

        return view('clinic.manage', compact('clinic', 'user_data'));
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
        $validate = $request->validate([
            'clinic_followup' => ['required', 'unique:clinic,clinic_followup']
        ]);

        $clinic = new Clinic();
        $clinic->clinic_followup = $request->get('clinic_followup');
        $clinic->save();

        return redirect()->back()->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $clinic_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $clinic_id)
    {
        $clinic = Clinic::find($clinic_id);

        return response()->json($clinic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $clinic_id)
    {
        $clinic = Clinic::find($clinic_id);
        $clinic->clinic_followup = $request->get('clinic_followup');
        $clinic->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $clinic_id)
    {
        $clinic = Clinic::find($clinic_id);
        $clinic->delete();
    }
}
