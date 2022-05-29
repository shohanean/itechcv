<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use App\Skill;
use App\Subject;
use App\District;
use App\Upazila;
use App\DegreeTitle;
use App\CvRequest;
use App\PersonalInformation;
use App\CompanyProfile;
use App\CompanyIndustry;
use App\User;
use Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Carbon;

//use Artisan;

class EmployerController extends Controller
{

    function __construct()
    {
        $this->middleware('verified');
    }

    function employer(){

//        Artisan::call('make:controller TestController');
////
//        die('OK');

        $degreetitle = DegreeTitle::orderBy('degree_title', 'asc')->get();
        $skills = Skill::orderBy('skill_name', 'asc')->get();
        $subjects = Subject::orderBy('subject_name', 'asc')->get();
        $district = District::orderBy('name', 'asc')->get();

        return view('backend.employer_dashboard', ['skills' => $skills, 'subjects' => $subjects, 'district' => $district, 'degreetitle' =>$degreetitle]);
    }

    function cvRequest(Request $request){

        $request->validate([
            'expected_salary' => ['numeric'],
            'expected_cv' => ['numeric']
        ]);

        CvRequest::insert([
            'user_id' => Auth::id(),
            'skill_id' => json_encode($request->skill_id),
            'category_id' => $request->category_id,
            'location_id' => $request->location_id,
            'education_id' => $request->education_id,
            'job_experience' => $request->job_experience,
            'portfolio' => $request->portfolio,
            'training' => $request->training,
            'expected_salary' => $request->expected_salary,
            'expected_cv' => $request->expected_cv,
            'vacancy' => $request->vacancy,
            'note' => $request->note,
            'created_at' => Carbon::now()
        ]);

        return back()->with('message', 'CV Request Send Successfully');
    }

    function EmployerProfilePhoto(){

        $user_id = Auth::id();
        $personal_info = PersonalInformation::where('user_id', $user_id)->first();
        return view('backend.profile_photo', ['personal_info'=>$personal_info]);
    }

    function EmployerProfileImagePost(Request $request){

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

    function EmployerPasswordChange(){

        return view('backend.password');
    }

    function EmployerPasswordUpdate(Request $request){

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

    function CompanyProfile(){
        $auth_id = Auth::id();
        $company = CompanyProfile::where('user_id',  $auth_id)->first();
        $countries = Country::orderBy('name', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();
        $industries = CompanyIndustry::orderBy('industry_name', 'asc')->get();
        return view('backend.company_profile',[
            'company' => $company,
            'countries'=>$countries,
            'districts'=>$districts,
            'industries'=>$industries,
        ]);
    }

    function CompanyUpdate(Request $request){
        $auth_id = Auth::id();
        $company = CompanyProfile::where('user_id', $auth_id)->first();
        $company->company_trade_license = $request->company_trade_license;

        if ($request->hasFile('company_logo')) {
            $img_slug = str_replace(' ', '-', Auth::user()->name . '-' . Auth::id());
            $img_check = CompanyProfile::where('user_id', Auth::id())->first()->company_logo;

            if (file_exists(public_path('images/company-profile'.'/'.$img_check))) {
                unlink(public_path('images/company-profile' . '/' . $img_check));
            }
            $image = $request->file('company_logo');
            $ext = $img_slug.'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path('images/company-profile/').$ext);

            $company->company_name = $request->company_name;
            $company->company_address = $request->company_address;
            $company->company_founded = $request->company_founded;
            $company->country_id = $request->country_id;
            $company->district_id = $request->district_id;
            $company->upazila_id = $request->upazila_id;
            $company->company_description = $request->company_description;
            $company->company_logo = $ext;
            $company->save();
            return back()->with('CompanyInfo', 'Company Information Updated Successfully');
        }
        else{
            $company->company_name = $request->company_name;
            $company->company_address = $request->company_address;
            $company->company_founded = $request->company_founded;
            $company->country_id = $request->country_id;
            $company->district_id = $request->district_id;
            $company->upazila_id = $request->upazila_id;
            $company->company_description = $request->company_description;
            $company->save();
            return back()->with('CompanyInfo', 'Company Information Updated Successfully');
        }

    }

    function IndustryUpdate(Request $request){
        $auth_id = Auth::id();
        $company = CompanyProfile::where('user_id', $auth_id)->first();
        $company->industry_id = json_encode($request->industry_id);
        $company->save();
        return back()->with('CompanyIndustry', 'Company Industry Updated Successfully');
    }

    function ContactUpdate(Request $request){
        $auth_id = Auth::id();
        $company = CompanyProfile::where('user_id', $auth_id)->first();
        $company->company_trade_license = $request->company_trade_license;
        $company->contact_person = $request->contact_person;
        $company->contact_person_designation = $request->contact_person_designation;
        $company->contact_person_email = $request->contact_person_email;
        $company->contact_person_phone = $request->contact_person_phone;
        $company->save();
        return back()->with('CompanyContact', 'Company Contact Updated Successfully');
    }

    function CompanyList($id){
        $upazilla = Upazila::where('district_id', $id)->get();
        return response()->json($upazilla);
    }

    function EmployerPhoto(){

        return view('backend.employer_photo', [
            'auth' => Auth::user()
        ]);
    }

    function EmployerImagePost(Request $request){

        $request->validate([
            'pp' => ['required', 'image']
        ]);
        $auth_id = Auth::user();
        if ($request->hasFile('pp')){
            $img_slug = str_replace(' ', '-', $auth_id->name .'-'. $auth_id->id);
            $img_check = User::findOrFail($auth_id->id)->user_profile;


            if (file_exists(public_path('images/photo'.'/'.$img_check))){
                unlink(public_path('images/photo'.'/'.$img_check));
            }
            $image = $request->file('pp');
            $ext = $img_slug.'-'.Str::random(3).'.'.$image->getClientOriginalExtension();

            Image::make($image)->save(public_path('images/profile/').$ext);

            $employer = User::findOrFail($auth_id->id);
            $employer->user_profile = $ext;
            $employer->save();
            return back()->with('success', 'Profile Photo Added Successfully');
        }
        else{
            return back()->with('success', "You didn't add profile photo");
        }
    }
}
