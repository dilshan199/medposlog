<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class PatientController extends Controller
{
    //
    public function index()
    {
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

        }

        // Fetch frequency type
        $frequency = DB::table('frequency')
        ->select('*')
        ->get();

        // Fetch problems
        $problem = DB::table('problem')
        ->select('*')
        ->get();

        // Fetch investigation
        $investigation = DB::table('investigation')
        ->select('*')
        ->get();

        // Fetch normal drugs
        $normal_drugs = DB::table('drugs')
        ->select('*')
        ->where('code', '=', 'ND')
        ->get();

        //Fetch special drugs
        $special_drugs = DB::table('drugs')
        ->select('*')
        ->where('code', '=', 'SD')
        ->get();

        // Fetch clinic followup
        $clinic = DB::table('clinic')
        ->select('*')
        ->get();

        // Fetch note
        $note = DB::table('note')
        ->select('*')
        ->get();

        $max_patient_id = DB::table('patient')
        ->select(DB::raw('max(patient_id) as max_id'))
        ->first();

        $patient_id = $max_patient_id->max_id + 1;

        $compact = [
            'user_data' => $user,
            'frequency' => $frequency,
            'problem' => $problem,
            'investigation' => $investigation,
            'clinic' => $clinic,
            'normal_drugs' => $normal_drugs,
            'special_drugs' => $special_drugs,
            'note' => $note,
            'patient_id' => $patient_id

        ];

        return view('patient.patient', $compact);
    }

    public function store(Request $request)
    {
        $patient = new Patient();

        session()->put([
            'patient_id' => $request->get('patient_id'),
            'title' => $request->get('title'),
            'name' => $request->get('name'),
            'nic' => $request->get('nic'),
            'contact_no' => $request->get('contact_no'),
            'age' => $request->get('age')
        ]);

        // Insert patient basic information
        DB::table('patient')
        ->updateOrInsert(
            ['patient_id' => $request->get('patient_id')],
            [
                'title' => $request->get('title'),
                'name' => $request->get('name'),
                'nic' => $request->get('nic'),
                'contact_no' => $request->get('contact_no'),
                'age' => $request->get('age')
            ]
        );

        // Return redirect to back
        return redirect()->back()->with('success', 'Patient information added successfully');
    }

    public function savePrescription(Request $request)
    {

    }

    public function addInvestigation(Request $request)
    {
        DB::table('investigation')
        ->insert([
            'investigation' => $request->get('investigation')
        ]);
    }

    public function addProblem(Request $request)
    {
        DB::table('problem')
        ->insert([
            'problem' => $request->get('problem')
        ]);
    }

    public function addNote(Request $request)
    {
        DB::table('note')
        ->insert([
            'note' => $request->get('note')
        ]);
    }

    public function addClinic(Request $request)
    {
        DB::table('clinic')
        ->insert([
            'clinic_followup' => $request->get('clinic_followup')
        ]);
    }

    public function addNormalDrug(Request $request)
    {
        DB::table('drugs')
        ->insert([
            'code' => $request->get('code'),
            'drug_name' => $request->get('drug_name'),
            'dosage' => '0'
        ]);
    }

    public function addSpecialDrug(Request $request)
    {
        DB::table('drugs')
        ->insert([
            'code' => $request->get('code'),
            'drug_name' => $request->get('drug_name'),
            'dosage' => '0'
        ]);
    }

    public function clearAll(Request $request)
    {
        // Remove all session values
        $request->session()->forget('patient_id');
        $request->session()->forget('title');
        $request->session()->forget('name');
        $request->session()->forget('nic');
        $request->session()->forget('contact_no');
        $request->session()->forget('age');
        $request->session()->forget('allegic_status');
        $request->session()->forget('allegic_des');
        $request->session()->forget('sh');
        $request->session()->forget('kg');
        $request->session()->forget('bp');
        $request->session()->forget('investigation');
        $request->session()->forget('next_day_investigation');
        $request->session()->forget('clinic_followup');
        $request->session()->forget('note');
        $request->session()->forget('problem');
        $request->session()->forget('check_date');

        return redirect()->back();
    }

    public function getPrevoiusDate(Request $request)
    {
        // Get prevoius date for related patient
        $prevoius_date = DB::table('patient_records')
        ->select('check_date')
        ->where('patient_id', '=', $request->get('patient_id'))
        ->get();

        $html = '';
        $html .= '<option value="" selected disabled>Prevoius Date</option>';
        foreach($prevoius_date as $pd){
            $html .= '<option value="'.$pd->check_date.'">'.$pd->check_date.'</option>';
        }

        echo $html;
    }

    public function getPatientRecords(Request $request)
    {
        // Remove all session values
        $request->session()->forget('patient_id');
        $request->session()->forget('title');
        $request->session()->forget('name');
        $request->session()->forget('nic');
        $request->session()->forget('contact_no');
        $request->session()->forget('age');
        $request->session()->forget('allegic_status');
        $request->session()->forget('allegic_des');
        $request->session()->forget('sh');
        $request->session()->forget('kg');
        $request->session()->forget('bp');
        $request->session()->forget('investigation');
        $request->session()->forget('next_day_investigation');
        $request->session()->forget('clinic_followup');
        $request->session()->forget('note');
        $request->session()->forget('problem');
        $request->session()->forget('check_date');

        // Check check date is empty or not
        if (!empty($request->get('check_date'))) {
            // If check date is not empty fetch all patient records
            $patient = DB::table('patient')
            ->select('*')
            ->join('patient_records', 'patient.patient_id', '=', 'patient_records.patient_id')
            ->where('patient.patient_id', '=', $request->get('patient_id'))
            ->first();

            // Store all details for the session
            session()->put([
                'patient_id' => $patient->patient_id,
                'title' => $patient->title,
                'name' => $patient->name,
                'nic' => $patient->nic,
                'contact_no' => $patient->contact_no,
                'age' => $patient->age,
                'allegic_status' => $patient->allegic_status,
                'allegic_des' => $patient->allegic_desc,
                'sh' => $patient->sh,
                'kg' => $patient->kg,
                'bp' => $patient->bp,
                'investigation' => $patient->investigation,
                'problem' => $patient->problem,
                'not' => $patient->note,
                'clinic_followup' => $patient->clinic_followup,
                'check_date' => $patient->check_date
            ]);

            return redirect()->back();
        }else{
            // Else check date is empty get only patient basic information
            $patient = DB::table('patient')
            ->select('*')
            ->join('patient_records', 'patient.patient_id', '=', 'patient_records.patient_id')
            ->where('patient.patient_id', '=', $request->get('patient_id'))
            ->orWhere('nic', '=', $request->get('nic'))
            ->orWhere('contact_no', '=', $request->get('contact_no'))
            ->first();

            // Store all details for the session
            session()->put([
                'patient_id' => $patient->patient_id,
                'title' => $patient->title,
                'name' => $patient->name,
                'nic' => $patient->nic,
                'contact_no' => $patient->contact_no,
                'age' => $patient->age
            ]);

            return redirect()->back();
        }
    }

    public function userPanel()
    {
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data = $user;
        }

        $max_patient_id = DB::table('patient')
        ->select(DB::raw('max(patient_id) as max_id'))
        ->first();

        $patient_id = $max_patient_id->max_id + 1;

        return view('patient.user-panel', compact('user_data', 'patient_id'));
    }

    public function addPatientData(Request $request)
    {
        session()->put([
            'allegic_status' => $request->get('allegic_status'),
            'allegic_des' => $request->get('allegic_des'),
            'sh' => $request->get('sh'),
            'kg' => $request->get('kg'),
            'bp' => $request->get('bp'),
            'investigation' => $request->get('investigation'),
            'next_day_investigation' => $request->get('next_day_investigation'),
            'problem' => $request->get('problem'),
            'note' => $request->get('note'),
            'clinic_followup' => $request->get('clinic_followup')
        ]);

        // Check records exit or not in send date
        $exit_records = DB::table('patient_records')
        ->select(DB::raw('count(*) as count'))
        ->where('patient_id', $request->get('patient_id'))
        ->where('check_date', $request->get('check_date'))
        ->first();

        if($exit_records->count > 0){
            return redirect()->back()->with('error', 'Record already exit in this <strong>'.$request->get('check_date').'</strong> date. <strong>Can\'t update old patient records</strong>. Please select another date to insert new patient records');
        }else{
            DB::table('patient_records')
            ->insert([
                'patient_id' => $request->get('patient_id'),
                'allegic_status' => $request->get('allegic_status'),
                'allegic_desc' => $request->get('allegic_des'),
                'sh' => $request->get('sh'),
                'kg' => $request->get('kg'),
                'bp' => $request->get('bp'),
                'investigation' => $request->get('investigation'),
                'next_day_investigation' => $request->get('next_day_investigation'),
                'clinic_followup' => $request->get('clinic_followup'),
                'note' => $request->get('note'),
                'problem' => $request->get('problem'),
                'check_date' => $request->get('check_date')

            ]);

            return redirect()->back()->with('success', 'Patient Data added successfully');
        }
    }

    /**
     * Prescription
     */

    public function addToCart(Request $request)
    {
        // Fetch drugs details related drug id
        $drug = DB::table('drugs')
        ->select('*')
        ->where('drug_id', '=', $request->get('drug_id'))
        ->first();

        //$cart = session()->get('cart', []);

        // if($drug->code == "ND"){

        // }


    }
}
