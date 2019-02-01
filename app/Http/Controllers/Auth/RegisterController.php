<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Organisation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
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
    protected $redirectTo = '/organisation-administrator-dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'organisation_name' => ['required', 'string', 'max:255', 'unique:organisations,name'],
                    'organisation_email' => ['required', 'string', 'email', 'max:255', 'unique:organisations,email'],
                    'telephone' => ['required', 'string'],
                    'postcode_zones' => ['required', 'string'],
                    'address1' => ['required', 'string'],
                    'address2' => ['string', 'nullable'],
                    'postcode' => ['required', 'string'],
                    'city_town' => ['required', 'string'],
                    'contact_person_name' => ['required', 'string', 'max:255', 'unique:users,name'],
                    'contact_person_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                    'password' => ['required', 'string', 'min:6', 'confirmed']
        ]);
    }

    /**
     * Create a new user and a new organisation instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        $org = organisation::create([
                    'name' => $data['organisation_name'],
                    'email' => $data['organisation_email'],
                    'telephone' => $data['telephone'],
                    'postcode_zones' => $data['postcode_zones'],
                    'address1' => $data['address1'],
                    'address2' => $data['address2'],
                    'postcode' => $data['postcode'],
                    'city_town' => $data['city_town']
        ]);

        return User::create([
                    'name' => $data['contact_person_name'],
                    'email' => $data['contact_person_email'],
                    'role' => 'administrator',
                    'organisation_id' => $org->id,
                    'password' => Hash::make($data['password']),
        ]);
    }

}
