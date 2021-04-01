<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Allergen;
use App\Models\Analysis;
use App\Models\AnalysisCount;
use Illuminate\Database\Eloquent\Collection;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //List patients
        $patients = Patient::orderBy('date_added','desc')->paginate(20);
        return view('patients.list_patients')->with('patients',$patients);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.add_patient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'patient_first' => 'required|max:100',
            'patient_last' => 'required|max:100',
            'chart_num' => 'required|max:25',
            'date_of_birth' => 'required',
            'sex' => 'required',
            'email' => 'email:rfc,dns|nullable',
            'zipcode_home' => 'max:12',
            'zipcode_work' => 'max:12',
        ]);

        $patient = new Patient();
        $new_patient = $patient->create($validated);
        $id= $new_patient->id;
        return redirect()->route('add_analysis',[$id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $slug = $request->input('search');
        if ($slug) {
            $patients = Patient::where('patient_last', '=',$slug )
                               ->orWhere('chart_num', '=', $slug)
                               ->orderBy('date_added','desc')->paginate(20);

            if (count($patients) != 0) {
                return view('patients.list_patients')->with('patients',$patients);    
            } else {
                return back()->with('message','Nothing found!');
            }
        } else {
            return back()->with('message','Nothing to Search for! Please enter a Last Name or Chart Number.');
        } 
    }
    
    public function createAnalysis($id )
    {
        $patient = Patient::findOrFail($id);
        $allergens = Allergen::all()->sortBy('group_id')->groupBy('group_id');
        return view('analysis.add_analysis')->with('patient', $patient)->with('allergens', $allergens); ;
    }

    public function storeAnalysis(Request $request)
    {

        $patient = Patient::findOrFail($request->patient_id);
        $validated = $request->validate([
            'MSP.*' => 'required|numeric|min:0|max:30',
            'ISP.*' => 'required|numeric|min:0|max:30',
            'treatment' => 'required|min:0|max:2',
        ]);
        // Store-> patient_id, allergen_id, MSP_score, IT_score, treatment
        $msp = $validated["MSP"];
        $isp = $validated["ISP"];

        if ( empty(array_diff_key ( $msp , $isp )) === true ) {
            $analysis_count = new AnalysisCount();
            $analysis_count->patient_id = $patient->id;
            foreach ($msp as $key => $value){
                $analysis = new Analysis();
                $analysis->patient_id = $patient->id;
                $analysis->allergen_id = $key;
                $analysis->treatment = $validated["treatment"];
                $analysis->MSP_score = $value;
                $analysis->IT_score = $isp[$key];
                $patient->analysis_count()->save($analysis_count);
                $analysis_count->analysis()->save($analysis);
            }
        } else {
            return back()->withErrors("Problem with Allergen Ids. Please see Tech Support.");
        }
        return redirect()->route('listPatients');
    }
    public function deleteAnalysis($id)
    {
        AnalysisCount::findOrFail($id)->delete();
        return back()->with('message',"Analysis Deleted!");

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('edit_patient')->with('patient', $patient)->with('allergens', $allergens); ;   
     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function editAnalysis($patient_id, $analysis_count_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $analysis_count = $patient->analysis_count()->find($analysis_count_id);
        $analysis = $analysis_count->analysis()->get();
        $allergens = Allergen::all()->sortBy('group_id');
        $treatment = ['treatment_type' => $analysis[0]->treatment, 'dilution_level' => $analysis[0]->dilution_level, 'refill' => $analysis[0]->refill];
        $analysis_keyed =  [];
        $results = new Collection();
        foreach($allergens as $allergen){
            $analysis_keyed[$allergen->id] = ['group_id'=> $allergen->group_id,  'name' => $allergen->antigen_name, 'file_name' => $allergen->file_name]; 
        }
        foreach($analysis as $analysis_record) {
            $results[$analysis_record['allergen_id']] = ['id'        => $analysis_record['allergen_id'],
                                                         'group_id'  => $analysis_keyed[$analysis_record['allergen_id']]['group_id'],
                                                         'name'      => $analysis_keyed[$analysis_record['allergen_id']]['name'],
                                                         'file_name' => $analysis_keyed[$analysis_record['allergen_id']]['file_name'],
                                                         'MSP_score' => $analysis_record['MSP_score'],
                                                         'IT_score'  => $analysis_record['IT_score'],
                                                         'two_whl'   => $analysis_record['two_whl']];
         }
         $results = $results->groupBy('group_id');
         return view('analysis.edit_analysis')->with('patient', $patient)->with('treatment', $treatment)->with('results', $results); 
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
        return back()->with('message',"Analysis Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
