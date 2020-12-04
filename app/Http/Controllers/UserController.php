<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUsernameRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use Alert;

class UserController extends Controller
{
    public function index()
    {

    	$users=User::paginate(5);
    	return view('listeUtilisateur', compact('users'));
    }

    public function delete($id)
    {
    	$user=User::find($id);
    	$user->delete();
    	return redirect('utilisateurs');
    }

    public function editUsername()
    {
        $user=auth()->user();
    	return view('editUsername',compact('user'));
    }

    public function updateUsername(UpdateUsernameRequest $request,User $user)
    {
    	$user->username=$request->username;
        $user->save();

        return redirect('souscripteurs/liste');
    }

    public function editPassword()
    {
        
        $user=auth()->user();
        return view('editPassword',compact('user'));
    }

    public function updatePassword(UpdatePasswordRequest $request,User $user)
    {
        $password_old=$request->password_old;
        if (Hash::check($password_old,$user->password)) {
            $user->password=bcrypt($request->password_new);
            $user->save();

            return redirect('souscripteurs/liste');
        }
        else
        {
             return view('editPassword',compact('user'))->with('erreur','Mot de passe incorrecte');
        }
        
    }
}
