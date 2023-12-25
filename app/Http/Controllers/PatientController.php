<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Carbon\Carbon;
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
        ->orderBy('problem', 'asc')
        ->get();

        // Fetch investigation
        $investigation = DB::table('investigation')
        ->select('*')
        ->orderBy('investigation', 'asc')
        ->get();

        // Fetch normal drugs
        $normal_drugs = DB::table('drugs')
        ->select('*')
        ->where('code', '=', 'ND')
        ->orderBy('drug_name', 'asc')
        ->get();

        //Fetch special drugs
        $special_drugs = DB::table('drugs')
        ->select('*')
        ->where('code', '=', 'SD')
        ->orderBy('drug_name', 'asc')
        ->get();

        //Fetch insulin
        $insulin = DB::table('drugs')
        ->select('*')
        ->where('code', '=', 'IN')
        ->get();

        // Fetch clinic followup
        $clinic = DB::table('clinic')
        ->select('*')
        ->orderBy('clinic_followup', 'asc')
        ->get();

        // Fetch note
        $note = DB::table('note')
        ->select('*')
        ->orderBy('note', 'asc')
        ->get();

        $max_patient_id = DB::table('patient')
        ->select(DB::raw('max(patient_id) as max_id'))
        ->first();

        $patient_id = $max_patient_id->max_id + 1;

        // Get max prescription id
        $max_prescription_id = DB::table('prescription')
        ->select(DB::raw('max(prescription_id) as max_id'))
        ->first();

        $prescription_id = $max_prescription_id->max_id + 1;

        $compact = [
            'user_data' => $user,
            'frequency' => $frequency,
            'problem' => $problem,
            'investigation' => $investigation,
            'clinic' => $clinic,
            'normal_drugs' => $normal_drugs,
            'special_drugs' => $special_drugs,
            'note' => $note,
            'patient_id' => $patient_id,
            'prescription_id' => $prescription_id,
            'insulin' => $insulin

        ];

        return view('patient.patient', $compact);
    }

    public function store(Request $request)
    {
        $patient = new Patient();

        // Check customer exit or not
        $exitCustomer = DB::table('patient')
        ->select(DB::raw('count(*) as user_count'))
        ->where('nic', '=', $request->get('nic'))
        ->first();

        // if exit get customer id from customer table
        if($exitCustomer->user_count > 0){
            $customerId = DB::table('patient')
            ->select('patient_id')
            ->where('nic', '=', $request->get('nic'))
            ->first();

            $patient_id = $customerId->patient_id;
        }else{
            if(!empty($request->get('patient_id'))){
                $patient_id = $request->get('patient_id');
            }else{
                // else generate customer id using customer table max id
                $customerMaxId = DB::table('patient')
                ->select(DB::raw('max(patient_id) as max_customer_id'))
                ->first();

                $patient_id = $customerMaxId->max_customer_id + 1;
            }
        }

        session()->put([
            'patient_id' => $patient_id,
            'title' => $request->get('title'),
            'name' => $request->get('name'),
            'nic' => $request->get('nic'),
            'contact_no' => $request->get('contact_no'),
            'age' => $request->get('age')
        ]);

        // Insert patient basic information
        DB::table('patient')
        ->updateOrInsert(
            ['patient_id' => $patient_id],
            [
                'title' => $request->get('title'),
                'name' => $request->get('name'),
                'nic' => $request->get('nic'),
                'contact_no' => $request->get('contact_no'),
                'age' => $request->get('age')
            ]
        );

        $current_date = Carbon::now('Asia/Colombo')->format('Y-m-d');

        DB::table('check_list')
        ->updateOrInsert(
            [
                'patient_id' => $patient_id,
                'date' => $current_date
            ],
            [
                'patient_id' => $patient_id,
                'date' => $current_date,
                'check_status' => 0
            ]
        );

        // Return redirect to back
        return redirect()->back()->with('success', 'Patient information added successfully');
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
        $request->session()->forget('current_problem');
        $request->session()->forget('check_date');
        $request->session()->forget('cart');
        $request->session()->forget('prescription_id');

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
        $request->session()->forget('kg');
        $request->session()->forget('bp');
        $request->session()->forget('investigation');
        $request->session()->forget('next_day_investigation');
        $request->session()->forget('clinic_followup');
        $request->session()->forget('note');
        $request->session()->forget('problem');
        $request->session()->forget('current_problem');
        $request->session()->forget('check_date');
        $request->session()->forget('prescription_id');
        $request->session()->forget('cart');

        // Check check date is empty or not
        if (!empty($request->get('check_date'))) {
            // If check date is not empty fetch all patient records
            $patient = DB::table('patient')
            ->select('*')
            ->join('patient_records', 'patient.patient_id', '=', 'patient_records.patient_id')
            ->where('patient.patient_id', '=', $request->get('patient_id'))
            ->where('check_date', '=', $request->get('check_date'))
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
                'kg' => $patient->kg,
                'bp' => $patient->bp,
                'investigation' => $patient->investigation,
                'problem' => $patient->problem,
                'current_problem' => $patient->current_problem,
                'note' => $patient->note,
                'clinic_followup' => $patient->clinic_followup,
                'check_date' => $patient->check_date,
                'next_day_investigation' => $patient->next_day_investigation
            ]);

            //Check patient have prescription
            $prescription_count = DB::table('prescription')
            ->select(DB::raw('count(patient_id) as pres_count'))
            ->where('patient_id', '=', $request->get('patient_id'))
            ->where('check_date', '=', $request->get('check_date'))
            ->first();

            // If exit prescription get all prescription data
            if($prescription_count->pres_count > 0){

                // Get prescription id related to patient
                $prescription = DB::table('prescription')
                ->select('prescription_id')
                ->where('patient_id', '=', $request->get('patient_id'))
                ->where('check_date', '=', $request->get('check_date'))
                ->first();

                session()->put([
                    'prescription_id' => $prescription->prescription_id
                ]);

                $prescription = DB::table('prescription_item')
                ->select('*')
                ->join('prescription', 'prescription.prescription_id', '=', 'prescription_item.prescription_id')
                ->where('prescription_item.prescription_id', '=', $prescription->prescription_id)
                ->where('check_date', '=', $request->get('check_date'))
                ->get();

                $cart = session()->get('cart', []);

                foreach($prescription as $pre){
                    $raw_id = uniqid();
                    if(empty($cart)){
                        $cart = [
                            $raw_id => [
                                'raw_id' => $raw_id,
                                'item_no' => $pre->raw_no,
                                'drug_id' => $pre->drug_id,
                                'drug_name' => $pre->drug_name,
                                'dose' => $pre->dose,
                                'frequency' => $pre->frequency,
                                'days' => $pre->days
                            ]
                        ];

                        // Add item to cart
                        session()->put('cart', $cart);
                    }else{
                        $cart[$raw_id] = [
                            'raw_id' => $raw_id,
                            'item_no' => $pre->raw_no,
                            'drug_id' => $pre->drug_id,
                            'drug_name' => $pre->drug_name,
                            'dose' => $pre->dose,
                            'frequency' => $pre->frequency,
                            'days' => $pre->days
                        ];

                        // Add item to cart
                        session()->put('cart', $cart);
                    }
                }
            }

            return redirect()->back();
        }else{
            if(!empty($request->get('patient_id')) || !empty($request->get('nic')) || !empty($request->get('contact_no'))){
                // Else check date is empty get only patient basic information
                $patient = DB::table('patient')
                ->select('*')
                ->where('patient_id', '=', $request->get('patient_id'))
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
            }else{
                return redirect()->back()->with('error', 'Please type key word and search patient');
            }
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

        // Fetch investigation
        $investigation = DB::table('investigation')
        ->select('*')
        ->orderBy('investigation', 'asc')
        ->get();

        // Fetch all patient basic information
        $patient = DB::table('patient')
        ->select('*')
        ->paginate(50);

        return view('patient.user-panel', compact('user_data', 'patient_id', 'patient', 'investigation'));
    }

    public function addPatientData(Request $request)
    {
        session()->put([
            'allegic_status' => $request->get('allegic_status'),
            'allegic_des' => $request->get('allegic_des'),
            //'sh' => $request->get('sh'),
            'kg' => $request->get('kg'),
            'bp' => $request->get('bp'),
            'investigation' => $request->get('investigation'),
            'next_day_investigation' => $request->get('next_day_investigation'),
            'problem' => $request->get('problem'),
            'current_problem' => $request->get('current_problem'),
            'note' => $request->get('note'),
            'clinic_followup' => $request->get('clinic_followup'),
            'check_date' => $request->get('check_date')
        ]);

        $current_date = Carbon::now('Asia/Colombo')->format('Y-m-d');

        if($current_date > $request->get('check_date')){
            return redirect()->back()->with('error', 'This is old medical record <strong>'.$request->get('check_date').'</strong> date. <strong>Can\'t update old patient records</strong>.');
        }else{
            DB::table('patient_records')
            ->updateOrInsert(
                [
                    'patient_id' => $request->get('patient_id'),
                    'check_date' => $request->get('check_date')
                ],
                [
                    'patient_id' => $request->get('patient_id'),
                    'allegic_status' => $request->get('allegic_status'),
                    'allegic_desc' => $request->get('allegic_des'),
                    //'sh' => $request->get('sh'),
                    'kg' => $request->get('kg'),
                    'bp' => $request->get('bp'),
                    'investigation' => $request->get('investigation'),
                    'next_day_investigation' => $request->get('next_day_investigation'),
                    'clinic_followup' => $request->get('clinic_followup'),
                    'note' => $request->get('note'),
                    'problem' => $request->get('problem'),
                    'current_problem' => $request->get('current_problem'),
                    'check_date' => $request->get('check_date')

                ]
            );

            return redirect()->back()->with('success', 'Patient Data added successfully');
        }
    }

    /**
     * Prescription
     */

    public function addToCart(Request $request)
    {
        // Store all basic and investigation data to session
        session()->put([
            'patient_id' => $request->get('patient_id'),
            'title' => $request->get('title'),
            'name' => $request->get('name'),
            'nic' => $request->get('nic'),
            'contact_no' => $request->get('contact_no'),
            'age' => $request->get('age'),
            'allegic_status' => $request->get('allegic_status'),
            'allegic_des' => $request->get('allegic_des'),
            'kg' => $request->get('kg'),
            'bp' => $request->get('bp'),
            'investigation' => $request->get('investigation'),
            'next_day_investigation' => $request->get('next_day_investigation'),
            'problem' => $request->get('problem'),
            'current_problem' => $request->get('current_problem'),
            'note' => $request->get('note'),
            'clinic_followup' => $request->get('clinic_followup'),
            'check_date' => $request->get('check_date')
        ]);

        if(!empty($request->get('drug_id'))){
            // Fetch drugs details related drug id
            $drug = DB::table('drugs')
            ->select('*')
            ->where('drug_id', '=', $request->get('drug_id'))
            ->first();

            $cart = session()->get('cart', []);
            $raw_id = uniqid();
            $count = $cart_count = 0;

            // If selected drug is normal drug. add details to array
            if($drug->code == "ND"){

                /**
                 * Check cart is empty
                 * if cart empty add first item for cart
                 */

                if(empty($cart)){
                    //foreach($cart_item_array as $cia){
                        $cart = [
                            $raw_id => [
                                'raw_id' => $raw_id,
                                'item_no' => 1,
                                'drug_id' => $request->get('drug_id'),
                                'drug_name' => $drug->drug_name,
                                'dose' => $drug->dosage,
                                'frequency' => (!empty($request->get('frequency1'))) ? $request->get('frequency1') : 'bd',
                                'days' => '30 days'
                            ]
                        ];

                        // Add item to cart
                        session()->put('cart', $cart);
                    //}
                }else{
                    $cart_count = count(session('cart'));
                    $count = $cart_count + 1;

                    $cart[$raw_id] = [
                        'raw_id' => $raw_id,
                        'item_no' => $count,
                        'drug_id' => $request->get('drug_id'),
                        'drug_name' => $drug->drug_name,
                        'dose' => $drug->dosage,
                        'frequency' => (!empty($request->get('frequency1'))) ? $request->get('frequency1') : 'bd',
                        'days' => '30 days'
                    ];

                    // Add item to cart
                    session()->put('cart', $cart);

                }

            }else{
                $count = 1;

                for ($i=0; $i < count($request->get('dose1')); $i++) {
                    $raw_id = uniqid().$i;
                    if(empty($cart)){
                        $cart = [
                            $raw_id => [
                                'raw_id' => $raw_id,
                                'item_no' => $count,
                                'drug_id' => $request->get('drug_id'),
                                'drug_name' => ($i == 0) ? $drug->drug_name : '',
                                'dose' => (!empty($request->get('dose1')[$i]))? $request->get('dose1')[$i].'mg' : '30mg',
                                'frequency' => (!empty($request->get('frequency1'))) ? $request->get('frequency1') : 'bd',
                                'days' => '30 days'
                            ]
                        ];

                        // Add item to cart
                        session()->put('cart', $cart);

                    }else{
                        $cart_count = count(session('cart'));
                        $count = $cart_count + 1;

                        $cart[$raw_id] = [
                            'raw_id' => $raw_id,
                            'item_no' => $count,
                            'drug_id' => $request->get('drug_id'),
                            'drug_name' => ($i == 0) ? $drug->drug_name : '',
                            'dose' => (!empty($request->get('dose1')[$i]))? $request->get('dose1')[$i].'mg' : '30mg',
                            'frequency' => (!empty($request->get('frequency1'))) ? $request->get('frequency1') : 'bd',
                            'days' => '30 days'
                        ];

                        // Add item to cart
                        session()->put('cart', $cart);
                    }
                }
            }
        }else{
            return redirect()->back()->with('error', 'Please select drug');
        }

        return redirect()->back();
    }

    /**
     * Update cart item
     */
    public function updateCart(Request $request)
    {
        $field = $request->get('field');
        $raw_id = $request->get('id');
        $cart = session()->get('cart');

        if(isset($cart[$raw_id]))
        {
            $cart[$raw_id][$field] = $request->get('value');
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Prescription updated succesfully');


        }
    }

    /**
     * Delete cart item
     */
    public function deleteCartItem(string $raw_id)
    {
        $cart = session()->get('cart');

        // Remove selected cart item
        if(isset($cart[$raw_id]))
        {
            unset($cart[$raw_id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    /**
     * Save Prescription
     */
    public function savePrescription(Request $request)
    {
        // Store values for session
        session()->put([
            'prescription_id' => $request->get('prescription_id')
        ]);

        $currentDate = Carbon::now('Asia/Colombo')->format('Y-m-d');

        // Generate unique barcode number
        $barcode = rand(10000000, 99999999);

         // Get patient count using post patient id
         $exitPatient = DB::table('patient')
         ->select(DB::raw('count(*) as patientCount'))
         ->where('patient_id', '=', $request->get('patient_id'))
         ->first();

         // if patient exit get patient id
         if($exitPatient->patientCount > 0){
             $patient = DB::table('patient')
             ->select('patient_id')
             ->where('patient_id', '=', $request->get('patient_id'))
             ->first();

            $patient_id = $patient->patient_id;

            // insert or update patient records
            DB::table('patient')
            ->updateOrInsert(
                [
                    'patient_id' => $patient_id
                ],
                [
                    'title' => $request->get('title'),
                    'name' => $request->get('name'),
                    'nic' => $request->get('nic'),
                    'contact_no' => $request->get('contact_no'),
                    'age' => $request->get('age'),
                    'address' => $request->get('address')
                ]
            );

            // Add daily registerd patient to check list table
            DB::table('check_list')
            ->updateOrInsert(
                [
                    'patient_id' => $patient_id,
                    'date' => $currentDate
                ],
                [
                    'patient_id' => $patient_id,
                    'date' => $currentDate,
                    'check_status' => 0
                ]
            );
        }else{
            // Else assign post patient id as patient id
            $patient_id = $request->get('patient_id');

            DB::table('patient')
            ->insert([
                'title' => $request->get('title'),
                'name' => $request->get('name'),
                'nic' => $request->get('nic'),
                'contact_no' => $request->get('contact_no'),
                'age' => $request->get('age'),
                'address' => $request->get('address'),
                'barcode' => $barcode
            ]);

            // Add daily registerd patient to check list table
            DB::table('check_list')
            ->updateOrInsert(
                [
                    'patient_id' => $patient_id,
                    'date' => $currentDate
                ],
                [
                    'patient_id' => $patient_id,
                    'date' => $currentDate,
                    'check_status' => 0
                ]
            );
        }

        //Store patient medicale records
        DB::table('patient_records')
        ->updateOrInsert(
            [
                'patient_id' => $patient_id,
                'check_date' => $request->get('check_date')
            ],
            [
                'patient_id' => $patient_id,
                'allegic_status' => $request->get('allegic_status'),
                'allegic_desc' => $request->get('allegic_des'),
                'kg' => $request->get('kg'),
                'bp' => $request->get('bp'),
                'investigation' => $request->get('investigation'),
                'next_day_investigation' => $request->get('next_day_investigation'),
                'clinic_followup' => $request->get('clinic_followup'),
                'note' => $request->get('note'),
                'problem' => $request->get('problem'),
                'current_problem' => $request->get('current_problem'),
                'check_date' => $request->get('check_date')

            ]
        );

        // Check patient id is empty
        if(!empty($request->get('patient_id'))){
            if(session('cart')){
                // Save prescription basic information
                DB::table('prescription')
                ->updateOrInsert(
                    [
                        'prescription_id' => $request->get('prescription_id'),
                        'patient_id' => $request->get('patient_id')
                    ],
                    [
                        'patient_id' => $request->get('patient_id'),
                        'check_date' => $request->get('check_date')
                    ]
                );

                // Check prescription exit or not
                $e_count = DB::table('prescription_item')
                ->select(DB::raw('count(*) as count'))
                ->where('prescription_id', '=', $request->get('prescription_id'))
                ->first();

                if($e_count->count > 0){
                    // Get all exit drug raw no set
                    $exit_raw_numbers = DB::table('prescription_item')
                    ->select('*')
                    ->where('prescription_id', '=', $request->get('prescription_id'))
                    ->get();

                    // Add all raw idis to array
                    foreach($exit_raw_numbers as $ern){
                        $exit_raw_array[] = $ern->raw_no;
                    }

                    // Get array raw numbers
                    if(session('cart')){
                        foreach(session('cart') as $cart){
                            $new_raw_numbers[] = $cart['item_no'];
                        }
                    }

                    // Check arrays and remove same numbers
                    $remove_numbers = array_merge(array_diff($exit_raw_array, $new_raw_numbers));

                    // Add item for prescription item table
                    if(session('cart')){
                        foreach(session('cart') as $cart){
                            DB::table('prescription_item')
                            ->updateOrInsert(
                                [
                                    'prescription_id' => $request->get('prescription_id'),
                                    'raw_no' => $cart['item_no']
                                ],
                                [
                                    'prescription_id' => $request->get('prescription_id'),
                                    'raw_no' => $cart['item_no'],
                                    'drug_id' => $cart['drug_id'],
                                    'drug_name' => $cart['drug_name'],
                                    'dose' => $cart['dose'],
                                    'frequency' => $cart['frequency'],
                                    'days' => $cart['days']
                                ]
                            );
                        }
                    }

                    // Remove deleted item
                    if(!empty($remove_numbers)){
                        for ($i=0; $i < count($remove_numbers); $i++) {
                            DB::table('prescription_item')
                            ->where('raw_no', '=', $remove_numbers[$i])
                            ->where('prescription_id', '=', $request->get('prescription_id'))
                            ->delete();
                        }
                    }

                    // Update check list table as patient visited
                    DB::table('check_list')
                    ->where('patient_id', '=', $request->get('patient_id'))
                    ->update(
                        ['check_status' => 1]
                    );

                    return redirect()->route('patient.print', [$request->get('prescription_id'), $request->get('check_date')]);

                }else{
                    // Store prescription item to database
                    if(session('cart')){
                        foreach(session('cart') as $cart){
                            DB::table('prescription_item')
                            ->updateOrInsert(
                                [
                                    'prescription_id' => $request->get('prescription_id'),
                                    'raw_no' => $cart['item_no']
                                ],
                                [
                                    'prescription_id' => $request->get('prescription_id'),
                                    'raw_no' => $cart['item_no'],
                                    'drug_id' => $cart['drug_id'],
                                    'drug_name' => $cart['drug_name'],
                                    'dose' => $cart['dose'],
                                    'frequency' => $cart['frequency'],
                                    'days' => $cart['days']
                                ]
                            );
                        }
                    }

                    // Update check list table as patient visited
                    DB::table('check_list')
                    ->where('patient_id', '=', $request->get('patient_id'))
                    ->update(
                        ['check_status' => 1]
                    );

                   return redirect()->route('patient.print', [$request->get('prescription_id'), $request->get('check_date')]);
                }
            }else{
               return redirect()->back()->with('error', 'No prescription to print');
            }
        }else{
            return redirect()->back()->with('error', 'Can\'t print the prescription. No patient selected');
        }
    }

    /**
     * Add Mixtard insulin
     */
    public function mistardInsulin(Request $request)
    {
        $dose = array(
            $request->get('m_dose_1'),
            $request->get('m_dose_2')
        );

        $frequency = array(
            $request->get('m_frequency_1'),
            $request->get('m_frequency_2')
        );

        $cart = session()->get('cart', []);
        $count = $cart_count = 0;
        for ($i=0; $i < count($dose); $i++) {
            $raw_id = uniqid().$i;
            if(empty($cart)){
                $count = 1;

                $cart = [
                    $raw_id => [
                        'raw_id' => $raw_id,
                        'item_no' => $count,
                        'drug_id' => $request->get('drug_id'),
                        'drug_name' => ($i == 0) ? $request->get('m_drug_name') : '',
                        'dose' => $dose[$i],
                        'frequency' => $frequency[$i],
                        'days' => '30 days'
                    ]
                ];

                // Add item to cart
                session()->put('cart', $cart);

            }else{
                $cart_count = count(session('cart'));
                $count = $cart_count + 1;

                $cart[$raw_id] = [
                    'raw_id' => $raw_id,
                    'item_no' => $count,
                    'drug_id' => $request->get('drug_id'),
                    'drug_name' => ($i == 0) ? $request->get('m_drug_name') : '',
                    'dose' => $dose[$i],
                    'frequency' => $frequency[$i],
                    'days' => '30 days'
                ];

                // Add item to cart
                session()->put('cart', $cart);
            }
        }

        return redirect()->back();
    }

    /**
     * Prescription print
     */
    public function print(int $prescription_id, string $check_date)
    {

        //Check prescription exit or not
        $exit = DB::table('prescription')
        ->select(DB::raw('count(*) as count'))
        ->where('prescription_id', '=', $prescription_id)
        ->first();

        $current_date = Carbon::now('Asia/Colombo')->format('Y-m-d');

        if($exit->count > 0){
            // Fetch patient id for related prescription
            $patient_id = DB::table('prescription')
            ->select('patient_id')
            ->where('prescription_id', '=', $prescription_id)
            ->first();

            // get patient basic and investigation data
            $patient = DB::table('patient')
            ->select('*')
            ->where('patient_id', '=', $patient_id->patient_id)
            ->first();

            //Check patient records exit or not in patient records table
            // $exit_patient_rec = DB::table('patient_records')
            // ->select(DB::raw('count(*) as exit_rec'))
            // ->where('patient_id', '=', $patient_id->patient_id)
            // ->where('check_date', '=', $current_date)
            // ->first();

            //if($exit_patient_rec->exit_rec > 0){
                $patient_rec = DB::table('patient_records')
                ->select('*')
                ->where('patient_id', '=', $patient_id->patient_id)
                ->where('check_date', '=', $check_date)
                ->first();
            // }else{

            // }

            //dd($patient_rec);

            // Get prescripiton data
            $prescription = DB::table('prescription')
            ->select('*')
            ->join('prescription_item', 'prescription_item.prescription_id', '=', 'prescription.prescription_id')
            ->where('prescription.prescription_id', '=', $prescription_id)
            ->get();

            return view('patient.print', compact('patient', 'prescription', 'patient_rec'));
        }else{
            return redirect()->back()->with('error', 'Can\'t print. No any prescription found');
        }
    }

    /**
     * Patient register [Reciptionist Side]
     */
    public function patientRegister(Request $request)
    {
        // Generate unique barcode number
        $barcode = rand(10000000, 99999999);

        // Get patient count using post patient id
        $exitPatient = DB::table('patient')
        ->select(DB::raw('count(*) as patientCount'))
        ->where('patient_id', '=', $request->get('patient_id'))
        ->first();

        // if patient exit get patient id
        if($exitPatient->patientCount > 0){
            $patient = DB::table('patient')
            ->select('patient_id')
            ->where('patient_id', '=', $request->get('patient_id'))
            ->first();

            $patient_id = $patient->patient_id;

            // insert or update patient records
            DB::table('patient')
            ->updateOrInsert(
                [
                    'patient_id' => $patient_id
                ],
                [
                    'title' => $request->get('title'),
                    'name' => $request->get('name'),
                    'nic' => $request->get('nic'),
                    'contact_no' => $request->get('contact_no'),
                    'age' => $request->get('age'),
                    'address' => $request->get('address')
                ]
            );
        }else{
            // Else assign post patient id as patient id
            $patient_id = $request->get('patient_id');

            // Else insert new patient
            DB::table('patient')
            ->insert([
                'title' => $request->get('title'),
                'name' => $request->get('name'),
                'nic' => $request->get('nic'),
                'contact_no' => $request->get('contact_no'),
                'age' => $request->get('age'),
                'address' => $request->get('address'),
                'barcode' => $barcode
            ]);
        }

        //Store all data to session
        session()->put([
            'patient_id_1' => $patient_id,
            'title_1' => $request->get('title'),
            'name_1' => $request->get('name'),
            'nic_1' => $request->get('nic'),
            'contact_no_1' => $request->get('contact_no'),
            'age_1' => $request->get('age'),
            'address_1' => $request->get('address'),
            'allegic_status_1' => $request->get('allegic_status'),
            'allegic_des_1' => $request->get('allegic_des'),
            'kg_1' => $request->get('kg'),
            'investigation_1' => $request->get('investigation')
        ]);

        // Define current date
        $currentDate = Carbon::now('Asia/Colombo')->format('Y-m-d');

        // Insert or update medicale records for patient
        DB::table('patient_records')
        ->updateOrInsert(
            [
                'patient_id' => $request->get('patient_id'),
                'check_date' => $currentDate
            ],
            [
                'patient_id' => $request->get('patient_id'),
                'allegic_status' => $request->get('allegic_status'),
                'allegic_desc' => $request->get('allegic_des'),
                'kg' => $request->get('kg'),
                'investigation' => $request->get('investigation'),
                'check_date' => $currentDate

            ]
        );

        // Add daily registerd patient to check list table
        DB::table('check_list')
        ->updateOrInsert(
            [
                'patient_id' => $patient_id,
                'date' => $currentDate
            ],
            [
                'patient_id' => $patient_id,
                'date' => $currentDate,
                'check_status' => 0
            ]
        );

        // Return redirect to back
        return redirect()->back()->with('success', 'Patient information added successfully');

    }

    /**
     * Clear form [Reciptionist]
     */
    public function clearForm(Request $request)
    {
        // Remove all session values
        $request->session()->forget('patient_id_1');
        $request->session()->forget('title_1');
        $request->session()->forget('name_1');
        $request->session()->forget('nic_1');
        $request->session()->forget('contact_no_1');
        $request->session()->forget('age_1');
        $request->session()->forget('allegic_status_1');
        $request->session()->forget('allegic_des_1');
        $request->session()->forget('kg_1');
        $request->session()->forget('address_1');
        $request->session()->forget('investigation_1');

        return redirect()->back();
    }

    /**
     * Patient search [Reciptionist]
     */
    public function patientSearch(Request $request)
    {
        //Assign current date
        $currentDate = Carbon::now('Asia/Colombo')->format('Y-m-d');

        // Remove old session values
        $request->session()->forget('patient_id_1');
        $request->session()->forget('title_1');
        $request->session()->forget('name_1');
        $request->session()->forget('nic_1');
        $request->session()->forget('contact_no_1');
        $request->session()->forget('address_1');
        $request->session()->forget('age_1');
        $request->session()->forget('kg_1');
        $request->session()->forget('allegic_status_1');
        $request->session()->forget('investigation_1');

        if(!empty($request->get('q'))){
            // Check any records exit in related to search keyword
            $exitPatient = DB::table('patient')
            ->select(DB::raw('count(*) as patientExit'))
            ->where('patient_id', '=', $request->get('q'))
            ->orWhere('nic', '=', $request->get('q'))
            ->orWhere('contact_no', '=', $request->get('q'))
            ->orWhere('barcode', '=', $request->get('q'))
            ->first();

            if($exitPatient->patientExit > 0){
                $patient = DB::table('patient')
                ->select('*')
                ->where('patient_id', '=', $request->get('q'))
                ->orWhere('nic', '=', $request->get('q'))
                ->orWhere('contact_no', '=', $request->get('q'))
                ->orWhere('barcode', '=', $request->get('q'))
                ->first();

                // Add all search result to session
                session()->put([
                    'patient_id_1' => $patient->patient_id,
                    'title_1' => $patient->title,
                    'name_1' => $patient->name,
                    'nic_1' => $patient->nic,
                    'contact_no_1' => $patient->contact_no,
                    'address_1' => $patient->address,
                    'age_1' => $patient->age
                ]);

                // Check medicale records available related patient id and currnet date
                $exitMedicaleRecords = DB::table('patient_records')
                ->select(DB::raw('count(*) as exitMedicaleRecords'))
                ->where('patient_id', '=', $patient->patient_id)
                ->where('check_date', '=', $currentDate)
                ->first();

                if($exitMedicaleRecords->exitMedicaleRecords > 0){
                    // Fetch medicale records
                    $medicaleRecords = DB::table('patient_records')
                    ->select('*')
                    ->where('patient_id', '=', $patient->patient_id)
                    ->where('check_date', '=', $currentDate)
                    ->first();

                    session()->put([
                        'kg_1' => $medicaleRecords->kg,
                        'allegic_status_1' => $medicaleRecords->allegic_status,
                        'investigation_1' => $medicaleRecords->investigation
                    ]);

                }

                return redirect()->back();
            }else{
                return redirect()->back()->with('error', 'Can\'t find patient-related records in search keyword');
            }
        }else{
            return redirect()->back()->with('error', 'Please enter any keyword to search patient');
        }
    }

    /**
     * Clear Prescription
     */
    public function clearPrescription(Request $request)
    {
        $request->session()->forget('cart');

        return redirect()->back();
    }

    /**
     * Patient list
     */
    public function patientList()
    {

        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data = $user;
        }

        $patient = DB::table('patient')
        ->select('*')
        ->paginate(50);

        return view('patient.list', compact('patient', 'user_data'));
    }

    /**
     * Admin patient search
     */
    public function seach(Request $request)
    {
        if(session()->has('loggedin')){
            $user = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

            $user_data = $user;
        }

        // Get patient related to search word
        $patient = DB::table('patient')
        ->select('*')
        ->where('patient_id', '=', $request->get('patient_id'))
        ->orWhere('nic', '=', $request->get('nic'))
        ->orWhere('contact_no', '=', $request->get('contact_no'))
        ->paginate(50);

        return view('patient.list', compact('user_data', 'patient'));
    }

    /**
     * Edit patient
     */
    public function editPatient(int $patient_id)
    {
        $patient = Patient::find($patient_id);

        return response()->json($patient);
    }

    /**
     * Update patient
     */
    public function updatePatient(Request $request, int $patient_id)
    {
        $patient = Patient::find($patient_id);
        $patient->title = $request->get('title');
        $patient->name = $request->get('name');
        $patient->nic = $request->get('nic');
        $patient->contact_no = $request->get('contact_no');
        $patient->save();
    }

    /**
     * Tempary function
     */
    public function viewPateintNew()
    {
        if(session()->has('loggedin')){
            $user_data = DB::table('users')->select('*')->where('user_id', '=', session('loggedin'))->first();

        }

        return view('patient.patient-new', compact('user_data'));
    }

    /**
     * New update
     */
    public function newUpdate(Request $request)
    {
        session()->put([
            'allegic_status' => $request->get('allegic_status'),
            'allegic_desc' => $request->get('allegic_des'),
            'kg' => $request->get('kg'),
            'bp' => $request->get('bp'),
            'investigation' => $request->get('investigation'),
            'next_day_investigation' => $request->get('next_day_investigation'),
            'clinic_followup' => $request->get('clinic_followup'),
            'note' => $request->get('note'),
            'problem' => $request->get('problem'),
            'current_problem' => $request->get('current_problem'),
            'check_date' => $request->get('check_date')
        ]);
    }
}
