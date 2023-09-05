<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class Items extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
