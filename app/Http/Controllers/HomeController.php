<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Artisan;
use Mail;
use Auth;
use App\Mail\CVSend;
use App\CvRequest;
use App\CvRequestCandidate;
use App\CompanyProfile;
use App\Skill;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.dashboard');
    }

    function employerRequested(){
        if(Auth::user()->user_role == 2){
          $cvrequests = CvRequest::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(10);
        }
        else{
          $cvrequests = CvRequest::orderBy('id', 'desc')->paginate(10);
        }
        return view('backend.request_from_employer',[
          'cvrequests' =>$cvrequests
        ]);
    }

    function employerRequestedDetails($cv_request_id){
        
        $cvrequestinfo = CvRequest::find($cv_request_id);
        return view('backend.request_from_employer_details',[
          'cvrequestinfo' => $cvrequestinfo,
          'cvrequestcandidates' => CvRequestCandidate::where('cv_request_id', $cv_request_id)->get(),
          'company' => CompanyProfile::where('user_id',$cvrequestinfo->user_id)->first(),
        ]);
    }

    function sendCV(){
      $data = [1,2,3];
      Mail::to('tariquehasan19@gmail.com')->send(new CVSend($data));
      return "OK";
    }

    function SkillPost(Request $request){
        $request->validate([
            'skill_name' => ['required', 'unique:skills']
        ]);

        Skill::insert([
            'skill_name' => $request->skill_name,
            'created_at' => Carbon::now()
        ]);

        return back()->with('success', 'Skill Added Successfully');
    }

    function SkillDelete($id){
        Skill::findOrFail($id)->delete();
        return back()->with('delete', 'Skill Deleted Successfully');
    }
    function SkillUpdate(Request $request){
        $request->validate([
            'skill_name' => ['required', 'unique:skills']
        ]);
        Skill::findOrFail($request->skill_id)->update([
            'skill_name' => $request->skill_name,
            'updated_at' => Carbon::now()
        ]);
        return back()->with('update', 'Skill Deleted Successfully');
    }
}
