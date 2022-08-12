<?php

namespace App\Http\Controllers;

use App\Drcaccount;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class DrcaccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drcaccounts = drcaccount::all();
        return view('drcaccounts.drcaccounts', compact('drcaccounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('drcaccounts.add-account', compact('users'));
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
                'email'            => 'required|unique:drcaccounts|regex:/(.*)beitbridge.whelson\.co\.zw$/i',
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

        $drcaccount = drcaccount::create([
            'user' => $request->input('user'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'prev_password' => $request->input('prev_password'),
            'last_agent' => $request->input('last_agent'),
        ]);
        $drcaccount->save();

        return redirect('drcaccounts')->with('success', 'O365 account for ' . $request->input('user') . ' has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\drcaccount  $drcaccount
     * @return \Illuminate\Http\Response
     */
    public function show(drcaccount $drcaccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\drcaccount  $drcaccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Drcaccount $drcaccount)
    {
        $users = User::all();
        return view('drcaccounts.edit-account', compact('drcaccount', 'users'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\drcaccount  $drcaccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, drcaccount $drcaccount)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user'                  => 'required',
                'email'            => 'required|regex:/(.*)beitbridge.whelson\.co\.zw$/i|unique:drcaccounts,email,' . $drcaccount->id,
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

        $drcaccount->user = $request->input('user');
        $drcaccount->email = $request->input('email');
        $drcaccount->password = $request->input('password');
        $drcaccount->prev_password = $request->input('prev_password');
        $drcaccount->last_agent = $request->input('last_agent');

        $drcaccount->save();

        return redirect('drcaccounts/' . $drcaccount->id . '/edit')->with('success', 'O365 account for ' . $request->input('user') . ' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\drcaccount  $drcaccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(drcaccount $drcaccount)
    {
        $drcaccount->delete();
        return redirect('drcaccounts')->with('success', 'Account has been deleted');
    }
}
