<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    /**
     * Load register form if user is not logged in.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function register()
    {
        if (!session()->get('name')) {
            return view('register');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Validate data and creating user if everything is fine.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $requestData = $request->all();
        $requestData['password'] = Hash::make($requestData['password']);
        Customer::create($requestData);

        session([
            'name' => request('name'),
            'email' => request('email')
        ]);

        return redirect('/');
    }


    /**
     * Validation parametrs.
     *
     * @param $request
     * @return array
     */
    public function validation($request)
    {
        return $this->validate($request, [
            'email' => 'required|email|max:255|unique:customers',
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'address' => 'required|max:255',
            'zipcode' => 'required|max:255',
            'city' => 'required|max:255',
            'phone' => 'required|numeric|digits-between:10,15'

        ]);
    }

    /**
     * Login attemp - if login and password from POST request match user will be logged in.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $customer = Customer::where('email', request('email'))->first();
        if (isset($customer->password) and Hash::check(request('password'), $customer->password)) {
            session([
                'name' => $customer->name,
                'email' => $customer->email,
                'id' => $customer->id
            ]);
            return redirect('/')->with('message', 'Zostałeś zalogowany!');
        } else {
            return redirect('/')->withErrors('Nieprawdiłowy login i/lub hasło!');
        }
    }


    /**
     * Logout and redirect to homepage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
