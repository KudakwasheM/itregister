<?php

namespace App\Http\Controllers;

use App\Beiraccount;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class BeiraccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beiraccounts = Beiraccount::all();
        return view('beiraccounts.beiraccounts', compact('beiraccounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('beiraccounts.add-account', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user'                  => 'required',
                'email'            => 'required|unique:beiraccounts|regex:/(.*)beitbridge.whelson\.co\.zw$/i',
                'password'             => 'required',
                'prev_password'                 => 'required',
                'last_agent'              => 'required',
            ],
            [
                'user.required'       => 'We need to know who will be using this account',
                'email.required'       => 'What is the email account?',
                'email.unique'       => 'This email was already added in the system.',
                'email.regex'       => 'IT Reggy appreciates your effort on typing this, however IT Reggy will save this account if its from the GDC Beitbridge domain!',
                'password.required'          => 'What is the password for the account?',
                'prev_password.required'  => 'What is the previous password for the account?',
                'last_agent.required'         => 'Please make sure that you are logged in.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $beiraccount = beiraccount::create([
            'user' => $request->input('user'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'prev_password' => $request->input('prev_password'),
            'last_agent' => $request->input('last_agent'),
        ]);
        $beiraccount->save();

        return redirect('beiraccounts')->with('success', 'O365 account for ' . $request->input('user') . ' has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beiraccount  $beiraccount
     * @return \Illuminate\Http\Response
     */
    public function show(Beiraccount $beiraccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beiraccount  $beiraccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Beiraccount $beiraccount)
    {
        $users = User::all();
        return view('beiraccounts.edit-account', compact('beiraccount', 'users'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Beiraccount  $beiraccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beiraccount $beiraccount)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user'                  => 'required',
                'email'            => 'required|regex:/(.*)beitbridge.whelson\.co\.zw$/i|unique:beiraccounts,email,' . $beiraccount->id,
                'password'             => 'required',
                'prev_password'                 => 'required',
                'last_agent'              => 'required',
            ],
            [
                'user.required'       => 'We need to know who will be using this account',
                'email.required'       => 'What is the email account?',
                'email.unique'       => 'This email was already added in the system.',
                'email.regex'       => 'IT Reggy appreciates your effort on typing this, however IT Reggy will save this account if its from the GDC Harare domain!',
                'password.required'          => 'What is the password for the account?',
                'prev_password.required'  => 'What is the previous password for the account?',
                'last_agent.required'         => 'Please make sure that you are logged in.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $beiraccount->user = $request->input('user');
        $beiraccount->email = $request->input('email');
        $beiraccount->password = $request->input('password');
        $beiraccount->prev_password = $request->input('prev_password');
        $beiraccount->last_agent = $request->input('last_agent');

        $beiraccount->save();

        return redirect('beiraccounts/' . $beiraccount->id . '/edit')->with('success', 'O365 account for ' . $request->input('user') . ' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Beiraccount  $beiraccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beiraccount $beiraccount)
    {
        $beiraccount->delete();
        return redirect('beiraccounts')->with('success', 'Account has been deleted');
    }
}
