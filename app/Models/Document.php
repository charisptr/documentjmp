<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
   use HasFactory;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'filename', 'expired_at', 'folder_id', 'created_by'
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array
    */
   protected $casts = [
      'expired_at' => 'datetime',
   ];

   public function folder()
   {
      return $this->belongsTo(Folder::class, 'folder_id', 'id');
   }

   public function createdBy()
   {
      return $this->belongsTo(User::class, 'created_by', 'id');
   }

   public function updatedBy()
   {
      return $this->belongsTo(User::class, 'updated_by', 'id');
   }
}
