<?php

namespace App\Http\Controllers\Auth;

use App\PersonalInformation;
use App\User;
use App\CompanyProfile;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        if ($data['looking'] == 'user'){

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'user_role' => 1,
            ]);

            PersonalInformation::insert([
                'user_id' => $user->id,
                'is_student' => $data['is_student'],
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'created_at' => Carbon::now()
            ]);

            return $user;
        }
        else{
            $employer = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'user_role' => 2,
            ]);

            CompanyProfile::insert([
                'user_id' => $employer->id,
                'phone' => $data['phone'],
                'company_name' => $data['company_name'],
                'company_trade_license' => $data['company_trade_license'],
                'created_at' => Carbon::now()
            ]);

            return  $employer;
        }
    }
}
