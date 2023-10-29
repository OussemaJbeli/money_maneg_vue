<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Memeber_incame extends Model
{

    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    protected $primaryKey = 'memeber_incame_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
