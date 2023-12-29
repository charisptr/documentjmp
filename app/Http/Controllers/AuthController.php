<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
   function login()
   {
      $expiredDate = now()->addDays(7);
      $documents = Document::where('expired_at', '<', $expiredDate)->orderBy("expired_at", 'asc')->get();
      $data = [
         'documents' => $documents
      ];
      return view("auth.login", $data);
   }
   function signin(Request $request)
   {
      $request->validate([
         'email' => 'required',
         'password' => 'required'
      ]);

      $login = User::where([
         'email' => strip_tags($request->email),
         'password' => strip_tags(sha1($request->password))
      ])->first();

      if ($login) {
         $sessdata['loggedAdmin'] = 'yes';
         $sessdata['id'] = $login->id;
         $sessdata['name'] = $login->name;
         $sessdata['email'] = $login->email;
         $request->session()->put($sessdata);
         return redirect('/home');
      } else {
         return redirect('/')->with('fail', 'Kamu salah!');
      }
   }

   public function signout()
   {
      Session::flush();
      Session::regenerate();
      return redirect('/');
   }
}
