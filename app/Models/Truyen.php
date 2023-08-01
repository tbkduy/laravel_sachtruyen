<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Truyen extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'tentruyen', 'tomtat', 'kichhoat', 'slug_truyen', 'hinhanh', 'danhmuc_id',
    ];
    protected $primaryKey = 'id';
    protected $table = 'truyen';

    public function danhmuctruyen(){
        return $this->belongsTo('App\Models\DanhmucTruyen', 'danhmuc_id', 'id');
    }

    public function chapter(){
        return $this->hasMany('App\Models\Chapter', 'truyen_id', 'id');
    }

    
    public function limitDesc(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::limit($this->tomtat, 50, '...')
        );
    }

    protected $appends = ['a_bc'];
}
