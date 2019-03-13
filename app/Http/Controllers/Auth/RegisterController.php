<?php

namespace App\Http\Controllers\Auth;

use App\Http\Models\User;
use App\Http\Controllers\Controller;
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
        return validator()->make($data, $this->rules(), $this->messages());
    }

    protected function rules(): array
    {
        return $rules = [
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    protected function messages(): array
    {
        return $messages = [
            'email.required' => trans('Podaj adres e-mail'),
            'email.string' => trans('Zły format adresu e-mail'),
            'email.email' => trans('Zły format adresu e-mail'),
            'email.max' => trans('Adres e-mail może zawierać maksymalnie 50 znaków'),
            'email.unique' => trans('Użytkownik o takim adresie e-amil już istnieje'),
            'password.required' => trans('Hasło wymagane'),
            'password.string' => trans('Zły format hasła'),
            'password.min' => trans('Hasło musi zawierać co najmniej 8 znaków'),
            'password.confirmed' => trans('Hasła muszą być jednakowe'),
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
