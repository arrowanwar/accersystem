<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class HqEndorseOrder extends Model
{
   use HasFactory, SoftDeletes;

    protected $table = 'hq_endorse_orders';

    protected $fillable = [
        'hq_er_id','memo_no','date',
    ];

    protected $casts = [ 'date' => 'date' ];

    public function hqEr()
    {
        return $this->belongsTo(HqEr::class);
    }

    public function officerEndorsements()
    {
        return $this->hasMany(OfficerEndorsement::class);
    }
}
