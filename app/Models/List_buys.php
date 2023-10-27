<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class List_buys extends Model
{

    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    protected $primaryKey = 'list_id';

    public function carrency()
    {
        return $this->belongsTo(Carrency::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
