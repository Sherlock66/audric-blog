<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
   /**
     * Create user
     */
    public function create(Request $request){

        $this->validate($request->all(),[
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'phone' => 'nullable|string',
            'job' => 'nullable|string',
            'address' => 'nullable|string',
            'linkedln' => 'nullable|string',
            'facebook' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);

        $data = $request->only(
            'first_name',
            'last_name',
            'country',
            'city',
            'phone',
            'job',
            'address',
            'linkedln',
            'facebook',
            'whatsapp',
            'email',
        );
        $birth = $request->birthday;
        $data['password'] = bcrypt($request->password);
        $data['picture'] = $this->uploadSingleFile($request, 'picture', 'users', ['image', 'mimes:jpeg,png,jpg']);

        $user = User::create($data);
        return back()->with('success', ' creation d\'un l\'utilisateur réussi!');
    }
    
    /**
     * delete one user
     */
    public function delete($id){
        if ( Auth::user()) {
            $user = User::find($id);
            $user->delete($user);
            return back()->with('success', "suppression de $user->first_name réussi!");
        } else {
            return back()->with('error', "Vous êtes pas connectez !");
        }
        
    }
}
