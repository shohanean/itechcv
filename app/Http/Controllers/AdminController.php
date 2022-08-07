<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Skill;
use App\JobSkill;
use App\DegreeTitle;
use App\Upazila;
use App\District;
use App\Education;
use App\PersonalInformation;
use App\JobExperience;
use App\CareerObjective;
use App\Portfolio;
use App\Training;
use App\User;
use App\Marketplace;
use App\CvRequest;
use App\CvRequestCandidate;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Mail\MailJobSeeker;
use Mail;
use Artisan;
class AdminController extends Controller
{
    function dashboard(){
        $user_id = User::whereIn('user_role', [2,3])->get();

        foreach($user_id as $ids){
            $arr[] = $ids->id ;
        }

        foreach (Skill::all() as $skill_from_db) {
          $skill_name_for_chart[] = strtoupper($skill_from_db->skill_name);
          $skill_amount_for_chart[] = JobSkill::where('skill_id', $skill_from_db->id)->count();
        }
        // Last 7 Days Calculation
        for ($i = 1; $i <= 7; $i++) {
          $seven_days_CV_request_date[] = Carbon::now()->subDays(7-$i)->format('d/m/Y');
          $seven_days_CV_request_data[] = CvRequest::whereDate('created_at', Carbon::now()->subDays(7-$i)->format('Y-m-d'))->count();

          $seven_days_CV_new_date[] = Carbon::now()->subDays(7-$i)->format('d/m/Y');
          $seven_days_CV_new_data[] = User::where('user_role', 1)->whereDate('created_at', Carbon::now()->subDays(7-$i)->format('Y-m-d'))->count();
        }
        return view('backend.admin_dashboard', [
          'PersonalInformation' => PersonalInformation::count(),
          'ctotal' => Subject::count(),
          'stotal' => Skill::count(),
          'cvtotal' => User::where('user_role', 1)->count(),
          'jstotal' => JobSkill::groupBy('user_id')->count(),
          'total_male' => PersonalInformation::where('gender', 1)->count(),
          'total_female' => PersonalInformation::where('gender', 2)->count(),
          'cit_in_student' => PersonalInformation::where('is_student', 1)->count(),
          'cit_out_student' => PersonalInformation::where('is_student', 2)->count(),
          'Seeker_Available' => PersonalInformation::where('job_status', 1)->whereNotIn('user_id', $arr)->count(),
          'Seeker_NotAvailable' => PersonalInformation::where('job_status', 2)->whereNotIn('user_id', $arr)->count(),
          'Seeker_InJob' => PersonalInformation::where('job_status', 3)->whereNotIn('user_id', $arr)->count(),
          'seven_days_CV_request_date' => $seven_days_CV_request_date,
          'seven_days_CV_request_data' => $seven_days_CV_request_data,
          'skill_name_for_chart' => $skill_name_for_chart,
          'skill_amount_for_chart' => $skill_amount_for_chart,
          'seven_days_CV_new_date' => $seven_days_CV_new_date,
          'seven_days_CV_new_data' => $seven_days_CV_new_data,
        ]);
    }

    function SearchSeeker(){

        $degreetitle = DegreeTitle::orderBy('degree_title', 'asc')->get();
        $skills = Skill::orderBy('skill_name', 'asc')->get();
        $subjects = Subject::orderBy('subject_name', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();

        return view('backend.admin_search', ['skills' => $skills, 'subjects' => $subjects, 'districts' => $districts, 'degreetitle' =>$degreetitle]);
    }

    function SearchResult(Request $request){
      $final_search[] = "Search Result";
      if(isset($request->skill_id)){
        $job_skill_searchs = JobSkill::whereIn('skill_id', $request->skill_id)->get();
        foreach ($job_skill_searchs as $job_skill_search) {
          if(Arr::has($final_search, $job_skill_search->user_id)){
            $old_value = Arr::get($final_search, $job_skill_search->user_id);
            $final_search[$job_skill_search->user_id] = $old_value + 1;
          }
          else {
            $final_search[$job_skill_search->user_id] = 1;
          }
        }
      }

      if(isset($request->location_id)){
        $location_searchs = PersonalInformation::whereJsonContains('interested_location', $request->location_id)->get();
        foreach ($location_searchs as $location_search) {
          if(Arr::has($final_search, $location_search->user_id)){
            $old_value = Arr::get($final_search, $location_search->user_id);
            $final_search[$location_search->user_id] = $old_value + 1;
          }
          else {
            $final_search[$location_search->user_id] = 1;
          }
        }
      }

      if(isset($request->category_id)){
        $category_searchs = PersonalInformation::whereJsonContains('job_category', $request->category_id)->get();
        foreach ($category_searchs as $category_search) {
          if(Arr::has($final_search, $category_search->user_id)){
            $old_value = Arr::get($final_search, $category_search->user_id);
            $final_search[$category_search->user_id] = $old_value + 1;
          }
          else {
            $final_search[$category_search->user_id] = 1;
          }
        }
      }

      if(isset($request->education_id)){
        $education_searchs = Education::where('degree_title_id', $request->education_id)->get();
        foreach ($education_searchs as $education_search) {
          if(Arr::has($final_search, $education_search->user_id)){
            $old_value = Arr::get($final_search, $education_search->user_id);
            $final_search[$education_search->user_id] = $old_value + 1;
          }
          else {
            $final_search[$education_search->user_id] = 1;
          }
        }
      }

      if($request->job_experience == 1){
        $job_experience_searchs = JobExperience::select('user_id')->groupBy('user_id')->get();
        foreach ($job_experience_searchs as $job_experience_search) {
          if(Arr::has($final_search, $job_experience_search->user_id)){
            $old_value = Arr::get($final_search, $job_experience_search->user_id);
            $final_search[$job_experience_search->user_id] = $old_value + 1;
          }
          else {
            $final_search[$job_experience_search->user_id] = 1;
          }
        }
      }

      if($request->portfolio == 1){
        $portfolio_searchs = Portfolio::select('user_id')->groupBy('user_id')->get();
        foreach ($portfolio_searchs as $portfolio_search) {
          if(Arr::has($final_search, $portfolio_search->user_id)){
            $old_value = Arr::get($final_search, $portfolio_search->user_id);
            $final_search[$portfolio_search->user_id] = $old_value + 1;
          }
          else {
            $final_search[$portfolio_search->user_id] = 1;
          }
        }
      }

      if($request->training == 1){
        $training_searchs = Training::select('user_id')->groupBy('user_id')->get();
        foreach ($training_searchs as $training_search) {
          if(Arr::has($final_search, $training_search->user_id)){
            $old_value = Arr::get($final_search, $training_search->user_id);
            $final_search[$training_search->user_id] = $old_value + 1;
          }
          else {
            $final_search[$training_search->user_id] = 1;
          }
        }
      }

      $salary_searchs = PersonalInformation::whereBetween('expected_salary',[$request->expected_salary_from,$request->expected_salary_to])->get();
      foreach ($salary_searchs as $salary_search) {
        if(Arr::has($final_search, $salary_search->user_id)){
          $old_value = Arr::get($final_search, $salary_search->user_id);
          $final_search[$salary_search->user_id] = $old_value + 1;
        }
        else {
          $final_search[$salary_search->user_id] = 1;
        }
      }

      // finishing touch
      Arr::forget($final_search, 0);
      arsort($final_search);

      //only showing job seeker & who is available, not in job
      foreach ($final_search as $user_id => $rank) {

        if(User::find($user_id)->user_role != 1){
          Arr::forget($final_search, $user_id);
        }

        if(PersonalInformation::where('user_id', $user_id)->first()->job_status != 1){
          Arr::forget($final_search, $user_id);
        }
      }

      // print_r($final_search);
      return redirect('admin/search')->with('final_search', $final_search);
      // finishing touch
      // die();


        // $skills = Skill::orderBy('skill_name', 'asc')->get();
        // $subjects = Subject::orderBy('subject_name', 'asc')->get();
        // $upazilas = Upazila::orderBy('name', 'asc')->get();
        //
        // $seekers = PersonalInformation::whereIn('job_category', [$request->category_id])->get();
        // $count = PersonalInformation::whereIn('job_category', [$request->category_id])->count();
        //
        // return view('backend.search', ['seekers' => $seekers, 'skills' => $skills, 'subjects' => $subjects, 'upazilas' => $upazilas, 'count'=>$count]);
    }

    function employerRequested(){

        return view('backend.request_from_employer');
    }

    function IndividualCV($p_id){

//        $auth = User::findOrFail($id);
        $personal_info = PersonalInformation::with('district', 'user')->where('user_id', $p_id)->first();
        // $id = $personal_info->user_id;
        $Obj = CareerObjective::where('user_id', $p_id)->first();
        $job_experiences = JobExperience::where('user_id', $p_id)->get();
        $jskills = JobSkill::where('user_id', $p_id)->with('skill')->get();
        $portfolios = Portfolio::where('user_id', $p_id)->get();
        $marketplaces = Marketplace::where('user_id', $p_id)->get();
        $educations = Education::where('user_id', $p_id)->get();

        return view('backend.view_cv_profile', [
            'educations' =>$educations,
            'marketplaces' =>$marketplaces,
            'portfolios' =>$portfolios,
            'jskills' =>$jskills ,
            'job_experiences' => $job_experiences,
            'Obj' => $Obj,
//            'auth' =>$auth,
            'personal_info' => $personal_info
        ]);
    }

    function AdminProfilePhoto(){

        $user_id = Auth::id();
        $personal_info = PersonalInformation::where('user_id', $user_id)->first();
        return view('backend.profile_photo', ['personal_info'=>$personal_info]);
    }

    function AdminProfileImagePost(Request $request){

        if ($request->hasFile('pp')){
            $img_slug = str_replace(' ', '-', Auth::user()->name .'-'. Auth::id());
            $img_check = PersonalInformation::where('user_id', Auth::id())->first()->user_profile;

            if (file_exists(public_path('images/photo'.'/'.$img_check))){

                unlink(public_path('images/photo'.'/'.$img_check));

                $image = $request->file('pp');
                $ext = $img_slug.'.'.$image->getClientOriginalExtension();

                Image::make($image)->resize(192, 192)->save(public_path('images/profile/').$ext);

                PersonalInformation::where('user_id', Auth::id())->update([
                    'user_profile' => $ext
                ]);
                return back()->with('success', 'Profile Photo Added Successfully');
            }
            else{
                $image = $request->file('pp');
                $ext = $img_slug.'.'.$image->getClientOriginalExtension();

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

    function AdminPasswordChange(){

        return view('backend.password');
    }

    function AdminPasswordUpdate(Request $request){

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

    function AllCVList(Request $request){

        // return $request;
        $user_id = User::whereIn('user_role', [2,3])->get();

        foreach($user_id as $ids){
            $arr[] = $ids->id ;
        }

        // $allcvs = PersonalInformation::whereNotIn('user_id', $arr)->latest()->get();
        $allcvs = PersonalInformation::whereNotIn('user_id', $arr)->where('phone',"like",'%'.$request->p_n.'%')->latest()->paginate();

        return view('backend.all_cv_list', ['allcvs' =>$allcvs]);
    }
    function mailjobseeker(Request $request){
        Mail::to($request->email)->send(new MailJobSeeker($request->message));
        return back()->with('success', 'Your message send successfully!');
    }

    function Skills(){

        return view('backend.skill', [
            'skills' => Skill::orderBy('skill_name')->paginate(20),
        ]);
    }
    function addtocvrequest(Request $request){
      $request->validate([
        'cv_request_id' => 'required'
      ]);
      CvRequestCandidate::insert([
        'cv_request_id' => $request->cv_request_id,
        'user_id' => $request->user_id,
        'created_at' => Carbon::now()
      ]);
      return back()->with('cv_send_sucess', 'CV Added to CV Request');
    }
}
