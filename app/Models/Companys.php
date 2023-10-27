<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Companys extends Model
{

    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    protected $primaryKey = 'company_id';


    public function memeber()
    {
        return $this->hasMany(Memebers::class);
    }

}
