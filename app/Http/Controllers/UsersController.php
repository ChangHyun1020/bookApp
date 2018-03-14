<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{

	public function __construct()
	{
		$this->middleware('guest');
	}

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $confirmCode = str_random(60);
        //dd($confirmCode);

        $user = \App\User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'confirm_code' => $confirmCode
        ]);

        // \Mail::send(
        // 	'emails.auth.confirm', compact('user'),
        // 	function ($message) use ($user) {
	    //  	$message->to($user->email);
	    //  	$message->subject(sprintf('[%s] 회원 가입을 확인해 주세요.', config('app.name')));
        // 	}
        // );
        event(new \App\Events\UserCreated($user));
        return $this->respondCreated('메일 보냈으니까 확인바람.');
    }

    protected function respondCreated($message)
    {
    	flash($message);
    	return redirect('/');
    }

    /**
     * Confirm user's email address.
     *
     * @param string $code
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirm($code)
    {
        $user = \App\User::whereConfirmCode($code)->first();

        if (! $user) {
            flash('URL이 정확하지 않습니다.');
            return redirect('/');
        }

        $user->activated = 1;
        $user->confirm_code = null;
        $user->save();

        flash(auth()->user()->name. '님 가입 확인했습니다.');

        return redirect('home');
    }
}
