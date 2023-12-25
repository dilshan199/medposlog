<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LettersController extends Controller
{
    /**
     * ACO Letter page
     */
    public function acoLetter()
    {
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data =  $user;
        }

        return view('letters.aco', compact('user_data'));
    }

    /**
     * ACO Letter Post
     */
    public function acoLetterPost(Request $request)
    {
        // Store session in form data
        session()->put([
            'aco_title' => $request->get('aco_title'),
            'aco_name' => $request->get('aco_name'),
            'aco_age' => $request->get('aco_age'),
            'aco_address' => $request->get('aco_address'),
            'aco_passport' => $request->get('aco_passport'),
            'aco_prescription' => $request->get('aco_prescription')
        ]);

        return view('letters.aco-print');
    }

    /**
     * ACO Letter Clear
     */
    public function acoLetterClear(Request $request)
    {
        // Clear Letter data
        $request->session()->forget('aco_title');
        $request->session()->forget('aco_name');
        $request->session()->forget('aco_age');
        $request->session()->forget('aco_address');
        $request->session()->forget('aco_passport');
        $request->session()->forget('aco_prescription');

        return redirect()->back();
    }

    /**
     * Fee Letter page
     */
    public function feeLetter(){
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data =  $user;
        }

        return view('letters.fee', compact('user_data'));
    }

    /**
     * Fee Letter post
     */
    public function feeLetterPost(Request $request)
    {
        // Store session in form data
        session()->put([
            'fee_title' => $request->get('fee_title'),
            'fee_name' => $request->get('fee_name'),
            'fee_age' => $request->get('fee_age'),
            'fee_address' => $request->get('fee_address'),
            'fee_des' => $request->get('fee_des'),
            'fee' => $request->get('fee'),
            'fee_text' => $request->get('fee_text')
        ]);

        return view('letters.fee-print');
    }

    /**
     * Fee later print
     */
    public function feeLetterClear(Request $request)
    {
        // Clear Letter data
        $request->session()->forget('fee_title');
        $request->session()->forget('fee_name');
        $request->session()->forget('fee_age');
        $request->session()->forget('fee_address');
        $request->session()->forget('fee_des');
        $request->session()->forget('fee');
        $request->session()->forget('fee_text');

        return redirect()->back();
    }

    /**
     * Leaves Letter page
     */
    public function leavesLetterPage()
    {
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data =  $user;
        }

        return view('letters.leave', compact('user_data'));
    }

    /**
     * Leaves letter print
     */
    public function leaveLetterPrint(Request $request)
    {
        // Store session in form data
        session()->put([
            'leave_n' => $request->get('leave_n'),
            'leave_title' => $request->get('leave_title'),
            'leave_name' => $request->get('leave_name'),
            'leave_age' => $request->get('leave_age'),
            'leave_address' => $request->get('leave_address'),
            'from' => $request->get('from'),
            'to' => $request->get('to'),
            'leave_problem' => $request->get('problem')
        ]);

        return view('letters.leave-print');
    }

    /**
     * Leave letter clear
     */
    public function leaveLetterClear(Request $request)
    {
        // Clear Letter data
        $request->session()->forget('leave_n');
        $request->session()->forget('leave_title');
        $request->session()->forget('leave_name');
        $request->session()->forget('leave_age');
        $request->session()->forget('leave_address');
        $request->session()->forget('from');
        $request->session()->forget('to');
        $request->session()->forget('leave_problem');

        return redirect()->back();
    }

    /**
     * Clinic Letter page
     */
    public function clinicLetterPage()
    {
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data =  $user;
        }

        return view('letters.clinic', compact('user_data'));
    }

    /**
     * Clinic letter print
     */
    public function clinicLetterPrint(Request $request)
    {
        // Store session in form data
        session()->put([
            'whom' => $request->get('whom'),
            'clinic_title' => $request->get('clinic_title'),
            'clinic_name' => $request->get('clinic_name'),
            'clinic_age' => $request->get('clinic_age'),
            'address' => $request->get('address'),
            'clinic_nic' => $request->get('clinic_nic'),
            'clinic_problem' => $request->get('clinic_problem'),
            'background' => $request->get('background')
        ]);

        return view('letters.clinic-print');
    }

    /**
     * Clinic letter clear
     */
    public function clinicLetterClear(Request $request)
    {
        // Clear Letter data
        $request->session()->forget('clinic_title');
        $request->session()->forget('clinic_name');
        $request->session()->forget('clinic_age');
        $request->session()->forget('whom');
        $request->session()->forget('address');
        $request->session()->forget('clinic_nic');
        $request->session()->forget('clinic_problem');
        $request->session()->forget('background');

        return redirect()->back();
    }

    /**
     * Letter page
     */
    public function letterPage()
    {
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data =  $user;
        }

        // Fetch doctor types
        $letter = DB::table('doctor_type')
        ->select('*')
        ->orderBy('type', 'asc')
        ->get();

        return view('letters.letter', compact('user_data', 'letter'));
    }

    /**
     * Letter print
     */
    public function letterPrint(Request $request)
    {
        // Store session in form data
        session()->put([
            'letter_whom' => $request->get('letter_whom'),
            'letter_type' => $request->get('letter_type'),
            'letter_title' => $request->get('letter_title'),
            'letter_name' => $request->get('letter_name'),
            'letter_age' => $request->get('letter_age'),
            'letter_address' => $request->get('letter_address'),
            'letter_problem' => $request->get('letter_problem')
        ]);

        // Insert unique doctor type for database
        DB::table('doctor_type')
        ->updateOrInsert(
            [
                'type' => $request->get('letter_type')
            ],
            [
                'type' => $request->get('letter_type')
            ]
        );

        return view('letters.letter-print');
    }

    /**
     * Letter clear
     */
    public function letterClear(Request $request)
    {
        // Clear Letter data
        $request->session()->forget('letter_title');
        $request->session()->forget('letter_name');
        $request->session()->forget('letter_age');
        $request->session()->forget('letter_address');
        $request->session()->forget('letter_whom');
        $request->session()->forget('letter_type');
        $request->session()->forget('letter_problem');

        return redirect()->back();
    }

    /**
     * Radiology Letter Page
     */
    public function radiologLetterPage()
    {
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data =  $user;
        }

        $illness = DB::table('illness')
        ->select('*')
        ->orderBy('illness', 'asc')
        ->get();

        return view('letters.r-letter', compact('user_data', 'illness'));
    }

    /**
     * Radiology Print
     */
    public function radiologyPrint(Request $request)
    {
        // Store session in form data
        session()->put([
            'r_letter_whom' => $request->get('r_letter_whom'),
            'r_letter_title' => $request->get('r_letter_title'),
            'r_letter_name' => $request->get('r_letter_name'),
            'r_letter_age' => $request->get('r_letter_age'),
            'r_letter_address' => $request->get('r_letter_address'),
            'r_letter_problem' => $request->get('r_letter_problem'),
            'illness' => $request->get('illness')
        ]);

        DB::table('illness')
        ->updateOrInsert(
            [
                'illness' => $request->get('illness')
            ],
            [
                'illness' => $request->get('illness')
            ]
        );

        return view('letters.r-letter-print');
    }

    /**
     * Radiology clear
     */
    public function radiologyClear(Request $request)
    {
        // Clear Letter data
        $request->session()->forget('r_letter_title');
        $request->session()->forget('r_letter_name');
        $request->session()->forget('r_letter_age');
        $request->session()->forget('r_letter_address');
        $request->session()->forget('r_letter_whom');
        $request->session()->forget('r_letter_problem');
        $request->session()->forget('illness');

        return redirect()->back();
    }

    /**
     * Admission Letter Page
     */
    public function admissionLetterPage()
    {
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data =  $user;
        }

        return view('letters.admission', compact('user_data'));
    }

    /**
     * Admission Print
     */
    public function admissionPrint(Request $request)
    {
        // Store session in form data
        session()->put([
            'cubical' => $request->get('cubical'),
            'admission_title' => $request->get('admission_title'),
            'admission_name' => $request->get('admission_name'),
            'admission_age' => $request->get('admission_age'),
            'admission_address' => $request->get('admission_address'),
            'admission_problem' => $request->get('admission_problem'),
        ]);

        return view('letters.admission-print');
    }

    /**
     * Admission clear
     */
    public function admissionClear(Request $request)
    {
        // Clear Letter data
        $request->session()->forget('admission_title');
        $request->session()->forget('admission_name');
        $request->session()->forget('admission_age');
        $request->session()->forget('admission_address');
        $request->session()->forget('cubical');
        $request->session()->forget('admission_problem');

        return redirect()->back();
    }

    /**
     * Blood picture letter page
     */
    public function bloodPictureLetter()
    {
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data =  $user;
        }

        return view('letters.b-letter', compact('user_data'));
    }

    /**
     * Blood picture letter print
     */
    public function bloodPictureLetterPrint(Request $request)
    {
        //Get array values
        $b_history_list = implode(',', $request->get('b_history'));

        // Store session in form data
        session()->put([
            'b_cubical' => $request->get('b_cubical'),
            'b_title' => $request->get('b_title'),
            'b_name' => $request->get('b_name'),
            'b_age' => $request->get('b_age'),
            'b_address' => $request->get('b_address'),
            'b_history' => $b_history_list
        ]);

        return view('letters.b-letter-print');
    }

    /**
     * Blood picture letter clear
     */
    public function bloodPictureLetterClear(Request $request)
    {
        // Clear Letter data
        $request->session()->forget('b_title');
        $request->session()->forget('b_name');
        $request->session()->forget('b_age');
        $request->session()->forget('b_address');
        $request->session()->forget('b_cubical');
        $request->session()->forget('b_history');

        return redirect()->back();
    }

    /**
     * Common letter page
     */
    public function commonLetterPage()
    {
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data =  $user;
        }

        return view('letters.common', compact('user_data'));
    }

    /**
     * Common letter print
     */
    public function commonPrint(Request $request)
    {
        // Store session in form data
        session()->put([
            'c_whom' => $request->get('c_whom'),
            'c_title' => $request->get('c_title'),
            'c_name' => $request->get('c_name'),
            'c_age' => $request->get('c_age'),
            'c_address' => $request->get('c_address'),
            'c_problem' => $request->get('c_problem')
        ]);

        return view('letters.common-print');
    }

    /**
     * Common letter clear
     */
    public function commonLetterClear(Request $request)
    {
        // Clear Letter data
        $request->session()->forget('c_title');
        $request->session()->forget('c_name');
        $request->session()->forget('c_age');
        $request->session()->forget('c_whom');
        $request->session()->forget('c_address');
        $request->session()->forget('c_problem');

        return redirect()->back();
    }
}
