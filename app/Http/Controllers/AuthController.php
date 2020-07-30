<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Notifications\ForgotPassword;

class AuthController extends Controller
{
    private static $tokenName = 'Audric Personal Access Token';

    public function login(Request $request)
    {
        if($request->isMethod('get'))
            return view('pages.login');
        else {
            $this->validate($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            $user = auth()->user();
            //var_dump($user->id);
            // return view('pages.')
            // return redirect()->route('dashboard', [$user]);
            // return redirect()->intended('dashboard');
        } else {
            return back()->with('error', "Incorrect username or password.");
        }
        }
       
    }

    /**
     * Log out current logged user
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/login');
        } else {
            return back()->with('error', "vous n'êtes pas connecté !");
        }
    }

    /**
     * Get the current logged user
    */
    public function user()
    {
        return Auth::user();
    }

     /**
     * take an username and generate reset code and send it by username if that username exists
     */
    public function forgotPassword(Request $request)
    {
        $this->validate($request->all(),[
            'email' => 'required|email|exists:App\User,email'
        ]);

        $user = User::where('email', $request->email)->first();

        DB::table('password_resets')->where('email', $user->email)->delete();

        $code = rand(1000, 9999);
        DB::table('password_resets')
            ->insert([
                'username' => $user->username,
                'code' => $code,
                'created_at' => Carbon::now()
            ]);

        $user->notify(new ForgotPassword($code));

        return back()->with('success', ' Veuillez verifier votre boite email votre pour activer votre compte !');;
    }

     /**
     * take code of user and password and reset the password that exists in database
     *
     */
    public function resetPassword(Request $request)
    {
        $this->validate($request->all(),[
            'code' => 'required|integer',
            'password' => 'required'
        ]);

        DB::table('password_resets')->whereDate('created_at', '<', Carbon::now()->subHour())->delete();
        $passwordReset = DB::table('password_resets')
                        ->where('code', $request->code)
                        ->first();

        if ($passwordReset) {
            User::where('username', $passwordReset->username)
                ->update([
                    'password' => bcrypt($request->password)
                ]);
            DB::table('password_resets')->where('code', $request->code)->delete();
        } else {
            abort(404);
        }

        return back()->with('success', ' mot de passe réinitialisé avec réussi!');
    }
}
