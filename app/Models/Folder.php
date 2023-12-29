<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
   use HasFactory;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'name', 'created_by',
   ];

   public function documents()
   {
      return $this->hasMany(Document::class, 'folder_id', 'id');
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
