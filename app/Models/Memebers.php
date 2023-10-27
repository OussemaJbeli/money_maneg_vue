<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Memebers extends Model
{

    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    protected $primaryKey = 'company_id';


    public function companys()
    {
        return $this->belongsTo(Companys::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
