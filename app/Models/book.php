<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    //
    protected $fillable = [
        'title',
        'author',
        'tahun_terbit',
        'category_id',
        'updated_at',
    ];

    public function category(){
        return $this->belongsTo(category::class);
    }
}
