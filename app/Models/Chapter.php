<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    // public $timestamps = false; //set time to false
    protected $fillable = [
        'truyen_id', 'tieude', 'noidung', 'kichhoat', 'slug_chapter', 'view'
    ];
    protected $primaryKey = 'id';
    protected $table = 'chapter';

    public function truyen(){
        return $this->belongsTo('App\Models\Truyen');
    }
}
