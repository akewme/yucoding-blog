<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class artikel extends Model
{
    protected $fillable = [
        'judul', 'isi', 'kategori','img','slug','user_id','video',
    ];
}
