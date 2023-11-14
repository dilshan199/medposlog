<?php

namespace App\Http\Controllers;

use App\Models\Frequency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $frequency = Frequency::paginate(50);

       if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data = $user;
        }

        return view('frequency.manage', compact('frequency', 'user_data'));
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
            'frequency' => ['required', 'unique:frequency,frequency']
        ]);

        $frequency = new Frequency();
        $frequency->frequency = $request->get('frequency');
        $frequency->save();

        return redirect()->back()->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $requency_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $frequency_id)
    {
        $frequency = Frequency::find($frequency_id);

        return response()->json($frequency);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $frequency_id)
    {
        $frequency = Frequency::find($frequency_id);
        $frequency->frequency = $request->get('frequency');
        $frequency->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $frequency_id)
    {
        $frequency = Frequency::find($frequency_id);
        $frequency->delete();
    }
}
