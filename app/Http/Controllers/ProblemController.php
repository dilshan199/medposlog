<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $problem = Problem::paginate(50);

        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data = $user;
        }

        return view('problem.manage', compact('problem', 'user_data'));
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
            'problem' => ['required', 'unique:problem,problem']
        ]);

        $problem = new Problem();
        $problem->problem = $request->get('problem');
        $problem->save();

        return redirect()->back()->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $problem_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $problem_id)
    {
        $problem = Problem::find($problem_id);

        return response()->json($problem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $problem_id)
    {
        $problem = Problem::find($problem_id);
        $problem->problem = $request->get('problem');
        $problem->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $problem_id)
    {
        $problem = Problem::find($problem_id);
        $problem->delete();
    }
}
