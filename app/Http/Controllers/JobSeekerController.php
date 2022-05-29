<?php

namespace App\Http\Controllers;

use App\Board;
use App\CareerObjective;
use App\Country;
use App\Degree;
use App\DegreeTitle;
use App\District;
use App\Education;
use App\JobExperience;
use App\JobSkill;
use App\Marketplace;
use App\PersonalInformation;
use App\Portfolio;
use App\Skill;
use App\Subject;
use App\Training;
use App\Upazila;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;
use PDF;
use Hash;

class JobSeekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('UserRole', ['except' => [
            'jobTopic',
            'subjectUpdate',
            'PasswordChange',
            'PasswordUpdate',
            'ProfilePhoto',
            'ProfileImagePost',
            'JobStatusChange',
        ]]);
    }

    function dashboard()
    {
        $skills = Skill::orderBy('skill_name', 'asc')->get();
        $subjects = Subject::orderBy('subject_name', 'asc')->get();
        $upazilas = Upazila::orderBy('name', 'asc')->get();

        return view('backend.dashboard', ['skills' => $skills, 'subjects' =>$subjects, 'upazilas' =>$upazilas]);
    }

    function CVUpdateForm()
    {

        $user_id = Auth::id();

        $auth = User::findOrFail($user_id);
        $personal_info = PersonalInformation::with(['district', 'pdistrict', 'upazila', 'pupazila', 'user'])->where('user_id', $user_id)->first();
        $countries = Country::orderBy('name', 'asc')->get();
        $boards = Board::orderBy('board_name', 'asc')->get();
        $degrees = Degree::all();
        $degree_title = DegreeTitle::orderBy('degree_title', 'asc')->get();
        $skills = Skill::orderBy('skill_name', 'asc')->get();
        $totalObj = CareerObjective::where('user_id', $user_id)->count();
        $districts = District::orderBy('name', 'asc')->get();
        $portfolios = Portfolio::all();

        //         Show Data
        $educations = Education::where('user_id', $user_id)->with('degree')->with('board')->get();
        $trainings = Training::where('user_id', $user_id)->with('country')->get();
        $Obj = CareerObjective::where('user_id', $user_id)->first();
        $JobSkill = JobSkill::where('user_id', $user_id)->with('skill')->get();
        $experience = JobExperience::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        $marketplaces = Marketplace::where('user_id', $user_id)->get();
        $portfolio_links = Portfolio::where('user_id', $user_id)->get();

        return view('backend.update_cv', ['marketplaces'=>$marketplaces,'portfolios' => $portfolios, 'portfolio_links' => $portfolio_links ,'districts' => $districts, 'personal_info' => $personal_info,'experience' => $experience, 'totalObj' => $totalObj, 'countries' => $countries, 'auth' => $auth, 'boards' => $boards, 'degrees' => $degrees, 'degree_title' => $degree_title, 'skills' => $skills, 'educations' => $educations, 'trainings' => $trainings, 'Obj' => $Obj, 'JobSkill' => $JobSkill]);
    }

    function PersonalInfoUpdate(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'email' => ['email'],
            'present_address' => ['required'],
            'district_id' => ['required'],
            'upazila_id' => ['required'],
            'permanent_address' => ['required'],
            'pdistrict_id' => ['required'],
            'pupazila_id' => ['required'],
            'expected_salary' => ['nullable','numeric'],
        ],[
            'district_id.required' => 'Must be select District',
            'upazila_id.required' => 'Must be select District',
            'pdistrict_id.required' => 'Must be select District',
            'pupazila_id.required' => 'Must be select Upazila',
            'expected_salary.numeric' => 'Expected Salary must be Number. Ex: 15000',
        ]);

//        return $request->all();
        User::findOrFail(Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        PersonalInformation::where('user_id', Auth::id())->update([
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'present_address' => $request->present_address,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'permanent_address' => $request->permanent_address,
            'pdistrict_id' => $request->pdistrict_id,
            'pupazila_id' => $request->pupazila_id,
            'nid' => $request->nid,
            'dob' => $request->dob,
            'marital_status' => $request->marital_status,
            'designation' => $request->designation,
            'expected_salary' => $request->expected_salary,
            'interested_location' => json_encode($request->interested_location),
            'updated_at' => Carbon::now()
        ]);
        return back()->with('personsuccess', 'Personal Information Updated Successfully');
    }

    function AddEducation(Request $request){

        foreach ($request->degree_name as $key => $value){

            Education::insert([
                'user_id' => Auth::id(),
                'degree_id' => $value,
                'result_point' => $request->results[$key],
                'degree_title_id' => $request->degree_title[$key],
                'passing_year' => $request->passing_year[$key],
                'major_field' => $request->major_study[$key],
                'duration' => $request->edu_duration[$key],
                'institute' => $request->edu_institute[$key],
                'board_id' => $request->board_name[$key],
                'created_at' =>Carbon::now()
            ]);
        }


        return back()->with('edusuccess', 'Education Added Successfully');
    }

    function EducationUpdate(Request $request){

        $edu = Education::findOrFail($request->edu_id);

        $edu->result_point = $request->results;
        $edu->degree_title_id = $request->degree_title;
        $edu->passing_year = $request->passing_year;
        $edu->major_field = $request->major_study;
        $edu->duration = $request->edu_duration;
        $edu->institute = $request->edu_institute;
        $edu->board_id = $request->board_name;
        $edu->save();

        return back()->with('EduUpdate', 'Education Updated Successfully');
    }


    function EducationDelete($id){
        Education::findOrFail($id)->delete();
        return back()->with('EduDelete', 'Education Deleted Successfully');
    }

    function AddTraining(Request $request){
      // return Training::find(370);
        // $request->validate([
        //     'training_name' => ['required'],
        //     'country_id' => ['required'],
        //     'topic_cover' => ['required'],
        //     'training_year' => ['required'],
        //     'training_institute' => ['required'],
        //     'training_duration' => ['required'],
        //     'training_location' => ['required'],
        // ], [
        //     'country_id.required' => 'Select Country',
        // ]);
        $auth = Auth::user()->id;

//        $training = Training::where('user_id', $auth)->count();
//        if ($training > 0){
//            foreach ($request->training_name as $key => $training) {
//                Training::findOrFail($auth)->update([
//                    'training_name' => $training,
//                    'country_id' => $request->trainingCountry[$key],
//                    'topic_cover' => $request->topic_cover[$key],
//                    'training_year' => $request->training_year[$key],
//                    'training_institute' => $request->trainingInstitute[$key],
//                    'training_duration' => $request->trainingduration[$key],
//                    'training_location' => $request->traininglocation[$key],
//                    'updated_at' => Carbon::now()
//                ]);
//                return back()->with('success', 'Training  Added Successfully');
//            }
//        }
//        else {
            foreach ($request->training_name as $key => $training) {

                Training::insert([
                    'user_id' => $auth,
                    'training_name' => $training,
                    'country_id' => $request->trainingCountry[$key],
                    'topic_cover' => $request->topic_cover[$key],
                    'training_year' => $request->training_year[$key],
                    'training_institute' => $request->trainingInstitute[$key],
                    'training_duration' => $request->trainingduration[$key],
                    'training_location' => $request->traininglocation[$key],
                    'created_at' =>Carbon::now()
                ]);
            }
            return back()->with('trainsuccess', 'Training  Added Successfully');
//        }

    }
    function TrainingUpdate(Request $request){
        $training = Training::findOrFail($request->training_id);
        $training->training_name = $request->training_name;
        $training->country_id = $request->trainingCountry;
        $training->topic_cover = $request->topic_cover;
        $training->training_year = $request->training_year;
        $training->training_institute = $request->trainingInstitute;
        $training->training_duration = $request->trainingduration;
        $training->training_location = $request->traininglocation;
        $training->save();

        return back()->with('TrainingUpdate', 'Training Updated Successfully');
    }
    function TrainingDelete($id){
        Training::findOrFail($id)->delete();
        return back()->with('TrainingDelete', 'Training Deleted Successfully');
    }
    function JobObjectivePost(Request $request){
        $request->validate([
            'objects' => ['required', 'min:200', 'max:500']
        ]);
        CareerObjective::insert([
            'user_id' => Auth::user()->id,
            'job_objective' => $request->objects,
            'created_at' => Carbon::now()
        ]);
        return back()->with('objectsuccess', 'CV Objective Added Successfully');
    }

    function JobObjectiveUpdate(Request $request){

        $request->validate([
            'objects' => ['required', 'min:200', 'max:500']
        ]);
        CareerObjective::where('user_id', Auth::user()->id)->update([
            'job_objective' => $request->objects,
            'updated_at' => Carbon::now()
        ]);
        return back()->with('success', 'CV Objective Updated Successfully');
    }

    function JobSkillPost(Request $request){

        $request->validate([
            'skills' => 'required',
            'progress' => 'required',
        ]);

        $user_id =  Auth::id();

//        foreach ($request->skills as $key => $value) {

            $jskill = JobSkill::where('user_id', $user_id)->where('skill_id', $request->skills)->count();


            if ($jskill <= 0) {

                JobSkill::insert([
                    'skill_id' => $request->skills,
                    'user_id' => $user_id,
                    'progress' => $request->progress,
                    'created_at' => Carbon::now()
                ]);
            }
            else{
                return back()->with('duplicateSkill', 'Skill Already Added Successfully');
            }
//        }
        return back()->with('skillsuccess', 'Skill Added Successfully');
    }

    function JobSkillDelete($id){

        $user_id = Auth::id();
        JobSkill::where('id', $id)->where('user_id', $user_id)->delete();

        return back()->with('delete', 'Skill Deleted Successfully');
    }

    function JobExperiencePost(Request $request){

        foreach ($request->company_name as $key => $value){
            JobExperience::insert([
                'user_id' => Auth::user()->id,
                'company_name' => $value,
                'designation' => $request->job_designation[$key],
                'job_from' => $request->job_from[$key],
                'job_summary' => $request->job_summary[$key],
                'job_to' => $request->job_to[$key],
                'created_at' => Carbon::now()
            ]);
        }
        return redirect('/update/my/cv#experienceInfo')->with('expersuccess', 'Job Experience Added Successfully');
    }
    function JobExperienceUpdate(Request $request){
        $experience = JobExperience::findOrFail($request->ex_id);
        $experience->company_name = $request->company_name;
        $experience->designation = $request->job_designation;
        $experience->job_from = $request->job_from;
        $experience->job_summary = $request->job_summary;
        $experience->job_to = $request->job_to;
        $experience->save();

        return back()->with('ExUpdate', 'Experience Update Successfully');
    }
    function ExperienceDelete($id){
        JobExperience::findOrFail($id)->delete();
        return back()->with('Exdelete', 'Experience Deleted Successfully');
    }

    function PortfolioPost(Request $request){
        $user_id = Auth::id();

        $request->validate([
            'portfolio_icon' => 'required',
            'portfolio_link' => 'required'
        ],[
            'portfolio_icon.required' => 'The portfolio name field is required'
        ]);

        Portfolio::insert([
            'user_id' => $user_id,
            'portfolio_icon' => $request->portfolio_icon,
            'portfolio_link' => $request->portfolio_link,
            'created_at' => Carbon::now()
        ]);
        return back()->with('portsuccess', 'Portfolio Added Successfully');
    }

    function PortfolioDelete($id){

      $user_id = Auth::id();
      Portfolio::where('id', $id)->where('user_id', $user_id)->delete();
      return back()->with('delete', 'Portfolio Deleted Successfully');
    }
    function MarketplacePost(Request $request){
        $user_id = Auth::id();

        $request->validate([
            'marketplace_icon' => 'required',
            'marketplace_link' => 'required'
        ],[
            'marketplace_icon.required' => 'The marketplace name field is required'
        ]);

        Marketplace::insert([
            'user_id' => $user_id,
            'marketplace_icon' => $request->marketplace_icon,
            'marketplace_link' => $request->marketplace_link,
            'created_at' => Carbon::now()
        ]);
        return back()->with('marketsuccess', 'Marketplace Added Successfully');
    }

    function MarketplaceDelete($id){
        Marketplace::findOrFail($id)->delete();
        return back()->with('MarketDelete', 'Marketplace Deleted Successfully');
    }

    function CVPreview(){

        $user_id = Auth::id();
        $Obj = CareerObjective::where('user_id', $user_id)->first();
        $auth = User::findOrFail($user_id);
        $personal_info = PersonalInformation::where('user_id', $user_id)->first();
        $job_experiences = JobExperience::where('user_id', $user_id)->get();
        $jskills = JobSkill::where('user_id', $user_id)->with('skill')->get();
        $portfolios = Portfolio::where('user_id', $user_id)->get();
        $marketplaces = Marketplace::where('user_id', $user_id)->get();
        $educations = Education::where('user_id', $user_id)->get();

        return view('backend.view_cv_profile', ['educations' =>$educations, 'marketplaces' =>$marketplaces,'portfolios' =>$portfolios, 'jskills' =>$jskills ,'job_experiences' => $job_experiences,'Obj' => $Obj,'auth' =>$auth, 'personal_info' => $personal_info]);
    }

    function UpazilaList($id){
            $upazilla = Upazila::where('district_id', $id)->orderBy('name', 'asc')->get();
        return response()->json($upazilla);
    }
    function GetDegreeTitle($id){
        $DegreeTitle = DegreeTitle::where('degree_id', $id)->get();
        return response()->json($DegreeTitle);
    }

    function PUpazilaList($id){
        $pupazilla = Upazila::where('district_id', $id)->get();
        return response()->json($pupazilla);
    }

    function PasswordChange(){

        return view('backend.password');
    }

    function PasswordUpdate(Request $request){

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->old_password , $hashedPassword )) {

            if (!Hash::check($request->password , $hashedPassword)) {

                $users =User::findOrFail(Auth::user()->id);
                $users->password = bcrypt($request->password);
                User::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));

                return back()->with('message','Password Updated Successfully');
            }

            else{
                return back()->with('danger2','New Password can not be the old password! Try New One');
            }
        }

        else{
            return back()->with('danger',"Old Password Doesn't Matched ");
        }
    }

    function ProfilePhoto(){

        $user_id = Auth::id();
        $personal_info = PersonalInformation::where('user_id', $user_id)->first();
        return view('backend.profile_photo', ['personal_info'=>$personal_info]);
    }

    function ProfileImagePost(Request $request){

        $request->validate([
            'pp' => ['required', 'image']
        ]);

        if ($request->hasFile('pp')){
            $img_slug = str_replace(' ', '-', Auth::user()->name .'-'. Auth::id());
            $img_check = PersonalInformation::where('user_id', Auth::id())->first()->user_profile;

            if (file_exists(public_path('images/photo'.'/'.$img_check))){

                unlink(public_path('images/photo'.'/'.$img_check));

                $image = $request->file('pp');
                $ext = $img_slug.'-'.Str::random(3).'.'.$image->getClientOriginalExtension();

                Image::make($image)->resize(192, 192)->save(public_path('images/profile/').$ext);

                PersonalInformation::where('user_id', Auth::id())->update([
                    'user_profile' => $ext
                ]);
                return back()->with('success', 'Profile Photo Added Successfully');
            }
            else{
                $image = $request->file('pp');
                $ext = $img_slug.'-'.Str::random(3).'.'.$image->getClientOriginalExtension();

                Image::make($image)->resize(192, 192)->save(public_path('images/profile/').$ext);

                PersonalInformation::where('user_id', Auth::id())->update([
                    'user_profile' => $ext
                ]);
                return back()->with('success', 'Profile Photo Added Successfully');
            }
        }
        else{
            return back()->with('success', "You didn't add profile photo");
        }
    }

    function jobTopic(){
        $user = Auth::id();
        $job = PersonalInformation::where('user_id', $user)->first();
        $subjects = Subject::orderBy('id', 'asc')->get();
        return view('backend.interested_topic', ['subjects' => $subjects, 'job' =>$job]);
    }

    function subjectUpdate(Request $request){
      if (!$request->subject_id) {
        return back()->with('not_select_error', 'You should choose at least 1 category');
      }
      if (count($request->subject_id) > 3) {
        return back()->with('more_than_3_error', 'You can not choose more than 3 categories');
      }
        $user = Auth::id();

        $jobCat = json_encode($request->subject_id);
        PersonalInformation::where('user_id', $user)->update([
            'job_category' => $jobCat,
            'updated_at' => Carbon::now()
        ]);
        return redirect(route('CVUpdateForm'))->with('category_add_success', 'Your category choose set successfully, you can now edit your CV if you want.');
    }
    function LivePreview(){
        $user_id = Auth::id();
        $Obj = CareerObjective::where('user_id', $user_id)->first();
        $auth = User::findOrFail($user_id);
        $personal_info = PersonalInformation::where('user_id', $user_id)->first();
        $job_experiences = JobExperience::where('user_id', $user_id)->get();
        $jskills = JobSkill::where('user_id', $user_id)->with('skill')->get();
        $portfolios = Portfolio::where('user_id', $user_id)->get();
        $marketplaces = Marketplace::where('user_id', $user_id)->get();
        $educations = Education::where('user_id', $user_id)->get();
        return view('backend.live_preview', [ 'educations' => $educations, 'marketplaces' =>$marketplaces,'portfolios' =>$portfolios, 'jskills' =>$jskills ,'job_experiences' => $job_experiences,'Obj' => $Obj,'auth' =>$auth, 'personal_info' => $personal_info]);
    }

    function pdfDownload()
    {
        $user_id = Auth::id();
        $Obj = CareerObjective::where('user_id', $user_id)->first();
        $auth = User::findOrFail($user_id);
        $personal_info = PersonalInformation::where('user_id', $user_id)->first();
        $job_experiences = JobExperience::where('user_id', $user_id)->get();
        $jskills = JobSkill::where('user_id', $user_id)->with('skill')->get();
        $portfolios = Portfolio::where('user_id', $user_id)->get();
        $marketplaces = Marketplace::where('user_id', $user_id)->get();
        $educations = Education::where('user_id', $user_id)->get();

        $pdf = PDF::loadView('backend.pdf', array('educations' => $educations, 'marketplaces' => $marketplaces, 'portfolios' => $portfolios, 'jskills' => $jskills, 'job_experiences' => $job_experiences, 'Obj' => $Obj, 'auth' => $auth, 'personal_info' => $personal_info))->setPaper('a3', 'portrait');

        return $pdf->download($auth->name . '.' . 'pdf');
    }

    function JobStatusChange($id){

        PersonalInformation::where('user_id', Auth::id())->update([
            'job_status' => $id
        ]);

        return back();
    }
}
