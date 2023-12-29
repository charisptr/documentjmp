<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
{
   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('AuthAdmin');
   }

   /**
    * Show the list of folder page.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index()
   {
      $folders = Folder::orderBy("name", 'asc')->withCount('documents')->get();
      return view('folder.index', compact('folders'));
   }

   /**
    * Store a new folder.
    * 
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function store(Request $request)
   {
      $request->validate([
         'name' => ['required', 'string', 'max:255', 'unique:folders'],
      ]);

      try {
         $folder = new Folder();
         $folder->name = $request->name;
         $folder->created_by = Session::get('id');
         $folder->updated_by = Session::get('id');
         $folder->save();
      } catch (\Exception $e) {
         return redirect()->back()->withErrors($e->getMessage());
      }

      return redirect()->route('folder.index')->with('success', 'Folder berhasil ditambahkan');
   }

   /**
    * Update a folder.
    * 
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function update(Request $request, $id)
   {
      $request->validate([
         'name' => ['required', 'string', 'max:255', 'unique:folders,name,' . $id],
      ]);

      try {
         $folder = Folder::findOrFail($id);
         $folder->name = $request->name;
         $folder->updated_by = Session::get('id');
         $folder->save();
      } catch (\Exception $e) {
         return redirect()->back()->withErrors($e->getMessage());
      }

      return redirect()->route('folder.index')->with('success', 'Folder berhasil diubah');
   }

   /**
    * Delete a folder.
    * 
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function destroy($id)
   {
      DB::beginTransaction();

      try {
         $folder = Folder::findOrFail($id);
         $documents = $folder->documents;
         foreach ($documents as $document) {
               $filepath = DocumentController::DOCUMENT_FILE_PATH . '/' . $document->filename;
               $document->delete();

               if (Storage::exists($filepath)) {
                  Storage::delete($filepath);
               }
         }
         $folder->delete();
      } catch (\Exception $e) {
         DB::rollBack();
         return redirect()->back()->withErrors($e->getMessage());
      }

      DB::commit();

      return redirect()->route('folder.index')->with('success', 'Folder berhasil dihapus');
   }
}
