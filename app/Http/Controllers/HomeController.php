<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class HomeController extends Controller
{   
   public function __construct()
   {
      $this->middleware('AuthAdmin');
   }

   public function index()
   {
      $expiredDate = now()->addDays(7);
      $documents = Document::where('expired_at', '<', $expiredDate)->orderBy("expired_at", 'asc')->get();               
      $data = [
         'documents' => $documents         
      ];
      
      return view('beranda.home', $data);
   }

   public function bantuan()
   {           
      return view('bantuan.bantuan');
   }
}
