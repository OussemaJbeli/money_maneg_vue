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

    protected $fillable = [
        'id_region',
        'id_currency', 
        'item_prix',
        'item_quentity'
    ];
    protected $primaryKey = 'id_item';
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function icons()
    {
        return $this->belongsTo(Icons::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function carrency()
    {
        return $this->belongsTo(Carrency::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
