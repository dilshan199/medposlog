<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class OauthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all records
        $user = User::paginate(50);

        if(session()->has('loggedin')){
            $user1 = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data = $user1;
        }

        return view('oauth.create', compact('user', 'user_data'));
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
        // Validate form data
        $validate = $request->validate([
            'user_type' => ['required'],
            'user_name' => ['required', 'unique:users,user_name'],
            'password' => ['required', Password::min(6)],
 
        ]);

        $user = new User();
        $user->user_type = $request->get('user_type');
        $user->user_name = $request->get('user_name');

        // Encrypt user password
        $encrypt_password = Hash::make($request->get('password'));
        $user->password = $encrypt_password;
        $retype_password = $request->get('retype_password');
        $user->save();

        // REdirect to create page
        return redirect()->back()->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $user_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $user_id)
    {
        // Fetch seletced user
        $user = User::find($user_id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $user_id)
    {
        // Update seletced user name only
        $user = User::find($user_id);
        $user->user_type = $request->get('user_type');
        $user->user_name = $request->get('user_name');
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user_id)
    {
        //Delete selected users
        $user = User::find($user_id);
        $user->delete();
    }

    /**
     * User sign in
     */
    public function signIn(Request $request)
    {
        //Check user fill all feild
        if(!empty($request->get('user_name')) && !empty($request->get('password'))) {

            // Check user account exit or notDB
            $user = DB::table('users')->select('user_name')->where('user_name', '=', $request->get('user_name'))->first();

            if($user){

                //Check user password valid or not
                $save_password = DB::table('users')->select('password')->where('user_name', '=', $request->get('user_name'))->first();

                if(Hash::check($request->get('password'), $save_password->password)){

                    $user_id = DB::table('users')->select('user_id')->where('user_name', '=', $request->get('user_name'))->first();
                    session()->put('loggedin',$user_id->user_id);

                    //Redirect to dashboard
                    return redirect('/')->with('success', 'Logging successfully');

                }else{

                    return redirect()->back()->with('error', 'Password invalid');

                }
            }else{

                return redirect()->back()->with('error', 'User account not found');

            }

        }else{

            return redirect()->back()->with('error', 'All feild are required.');

        }
    }

    /**
     * Sign out
     */
    public function signOut()
    {
        if(session()->has('loggedin')){
            session()->pull('loggedin');

            return redirect('/oauth/sign-in')->with('success', 'Successfully loggedout');
        }
    }

    /**
     * Home
     */
    public function home()
    {
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data =  $user;
        }

        $current_date = Carbon::now('Asia/Colombo')->format('Y-m-d');
        $total_registerd = $total_visited = $total_not_visited = 0;

        // Get total registerd patient
        $total_registerd_patient = DB::table('check_list')
        ->select(DB::raw('count(*) as registerd_patient'))
        ->where('date', '=', $current_date)
        ->first();

        $total_registerd = $total_registerd_patient->registerd_patient;

        // Get total visited patient related to current date
        $total_visited_patient = DB::table('check_list')
        ->select(DB::raw('count(*) as visited'))
        ->where('date', '=', $current_date)
        ->where('check_status', '=', '1')
        ->first();

        $total_visited = $total_visited_patient->visited;

        // Get total not visited patient related to current date
        $total_not_visited_patient = DB::table('check_list')
        ->select(DB::raw('count(*) as not_visited'))
        ->where('date', '=', $current_date)
        ->where('check_status', '=', '0')
        ->first();

        $total_not_visited = $total_not_visited_patient->not_visited;

        // Get all today registerd patient
        $patient = DB::table('check_list')
        ->select('*')
        ->join('patient', 'patient.patient_id', '=', 'check_list.patient_id')
        ->where('date', '=', $current_date)
        ->paginate(50);

        return view('welcome', compact('user_data', 'total_registerd', 'total_visited', 'total_not_visited', 'patient'));

    }
}
