<?php

namespace App\Http\Controllers;

use App\Models\Drugs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DrugsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drugs = Drugs::paginate(50);

        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data = $user;
        }

        return view('drugs.manage', compact('drugs', 'user_data'));
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
            'code' => ['required'],
            'drug_name' => ['required'],
            'dosage' => ['required']
        ]);

        $drugs = new Drugs();
        $drugs->code = $request->get('code');
        $drugs->drug_name = $request->get('drug_name');
        $drugs->dosage = $request->get('dosage');
        $drugs->save();

        return redirect()->back()->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $drug_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $drug_id)
    {
        $drugs = Drugs::find($drug_id);

        return response()->json($drugs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $drug_id)
    {
        $drugs = Drugs::find($drug_id);
        $drugs->code = $request->get('code');
        $drugs->drug_name = $request->get('drug_name');
        $drugs->dosage = $request->get('dosage');
        $drugs->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $drug_id)
    {
        $drugs = Drugs::find($drug_id);
        $drugs->delete();
    }
}
