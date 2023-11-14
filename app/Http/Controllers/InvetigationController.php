<?php

namespace App\Http\Controllers;

use App\Models\Investigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvetigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //
       $investigation = Investigation::paginate(50);

       if(session()->has('loggedin')){
        $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

        $user_data = $user;
    }

       return view('investigation.create', compact('investigation', 'user_data'));
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
            'investigation' => ['required', 'unique:investigation,investigation']
        ]);

        $investigation = new Investigation();
        $investigation->investigation = $request->get('investigation');
        $investigation->save();

        return redirect()->back()->with('success', 'Record addedd successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $investigation_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $investigation_id)
    {
        $investigation = Investigation::find($investigation_id);

        return response()->json($investigation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $investigation_id)
    {
        $investigation = Investigation::find($investigation_id);
        $investigation->investigation = $request->get('investigation');
        $investigation->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $investigation_id)
    {
        $investigation = Investigation::find($investigation_id);
        $investigation->delete();
    }
}
