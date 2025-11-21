<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model{
    
    protected $fillable = ['number'];
    use HasFactory;
    public $timestamps = false;

    public function season(){
         return $this->belongsTo(Season::class);
    }
}
