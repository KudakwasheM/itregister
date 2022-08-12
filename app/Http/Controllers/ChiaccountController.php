<?php

namespace App\Http\Controllers;

use App\Chiaccount;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class ChiaccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chiaccounts = Chiaccount::all();
        return view('chiaccounts.chiaccounts', compact('chiaccounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('chiaccounts.add-account', compact('users'));
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
                'email'            => 'required|unique:chiaccounts|regex:/(.*)beitbridge.whelson\.co\.zw$/i',
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

        $chiaccount = chiaccount::create([
            'user' => $request->input('user'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'prev_password' => $request->input('prev_password'),
            'last_agent' => $request->input('last_agent'),
        ]);
        $chiaccount->save();

        return redirect('chiaccounts')->with('success', 'O365 account for ' . $request->input('user') . ' has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\chiaccount  $chiaccount
     * @return \Illuminate\Http\Response
     */
    public function show(chiaccount $chiaccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chiaccount  $chiaccount
     * @return \Illuminate\Http\Response
     */
    public function edit(chiaccount $chiaccount)
    {
        $users = User::all();
        return view('chiaccounts.edit-account', compact('chiaccount', 'users'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\chiaccount  $chiaccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, chiaccount $chiaccount)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user'                  => 'required',
                'email'            => 'required|regex:/(.*)beitbridge.whelson\.co\.zw$/i|unique:chiaccounts,email,' . $chiaccount->id,
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

        $chiaccount->user = $request->input('user');
        $chiaccount->email = $request->input('email');
        $chiaccount->password = $request->input('password');
        $chiaccount->prev_password = $request->input('prev_password');
        $chiaccount->last_agent = $request->input('last_agent');

        $chiaccount->save();

        return redirect('chiaccounts/' . $chiaccount->id . '/edit')->with('success', 'O365 account for ' . $request->input('user') . ' has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chiaccount  $chiaccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(chiaccount $chiaccount)
    {
        $chiaccount->delete();
        return redirect('chiaccounts')->with('success', 'Account has been deleted');
    }
}
