<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Folder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JayaPatriotController extends Controller
{
   const DOCUMENT_FILE_PATH = 'documents';

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
    * Show the list of document page.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index()
   {
      $documents = Document::orderBy("expired_at", 'asc')->where('folder_id', 3)->get();
      $folders = Folder::orderBy("name", 'asc')->get();
      return view('document.jayapatriot', compact('documents', 'folders'));
   }
   
   public function download($id)
   {
      $document = Document::findOrFail($id);
      $filepath = DocumentController::DOCUMENT_FILE_PATH . '/' . $document->filename;
      if (!Storage::exists($filepath)) {
         return redirect()->back()->withErrors('File tidak ditemukan');
      }

      return Storage::download($filepath, $document->name . '.pdf');
   }

   public function store(Request $request)
   {
      $request->validate([
         'name' => ['required', 'string', 'max:255', 'unique:documents'],
         'expired_at' => ['required', 'date'],
         'file' => 'required|mimes:pdf|max:51200', // 50MB         
      ]);

      $filename = time() . '_' . $request->file('file')->getClientOriginalName();

      DB::beginTransaction();

      try {
         $document = new Document();
         $document->folder_id = 3;
         $document->name = $request->name;
         $document->filename = $filename;
         $document->expired_at = $request->expired_at;
         $document->created_by = Session::get('id');
         $document->updated_by = Session::get('id');
         $document->save();

         Storage::putFileAs(DocumentController::DOCUMENT_FILE_PATH, $request->file('file'), $filename);
      } catch (\Exception $e) {
         DB::rollBack();
         return redirect()->back()->withErrors($e->getMessage());
      }

      DB::commit();

      return redirect()->route('jayapatriot.index')->with('success', 'Dokumen berhasil ditambahkan');
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'name' => ['required', 'string', 'max:255', 'unique:documents,name,' . $id],
         'expired_at' => ['required', 'date'],
         'file' => 'mimes:pdf|max:51200', // 50MB         
      ]);

      DB::beginTransaction();

      try {
         $document = Document::findOrFail($id);

         $oldFilepath = DocumentController::DOCUMENT_FILE_PATH . '/' . $document->filename;

         $document->folder_id = 3;
         $document->name = $request->name;
         $document->expired_at = $request->expired_at;
         $document->updated_by = Session::get('id');

         if ($request->hasFile('file')) {
               $newFilename = time() . '_' . $request->file('file')->getClientOriginalName();
               $document->filename = $newFilename;
               $document->save();

               // Store the new file
               Storage::putFileAs(DocumentController::DOCUMENT_FILE_PATH, $request->file('file'), $newFilename);

               // Delete the old file
               if (Storage::exists($oldFilepath)) {
                  Storage::delete($oldFilepath);
               }
         } else {
               $document->save();
         }
      } catch (\Exception $e) {
         DB::rollBack();
         return redirect()->back()->withErrors($e->getMessage());
      }

      DB::commit();

      return redirect()->route('jayapatriot.index')->with('success', 'Dokumen berhasil diubah');
   }

 
   public function destroy($id)
   {
      DB::beginTransaction();

      try {
         $document = Document::findOrFail($id);
         $filepath = DocumentController::DOCUMENT_FILE_PATH . '/' . $document->filename;
         $document->delete();

         if (Storage::exists($filepath)) {
               Storage::delete($filepath);
         }
      } catch (\Exception $e) {
         DB::rollBack();
         return redirect()->back()->withErrors($e->getMessage());
      }

      DB::commit();

      return redirect()->route('jayapatriot.index')->with('success', 'Dokumen berhasil dihapus');
   }
}
