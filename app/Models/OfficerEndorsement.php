<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficerEndorsement extends Model
{
     use HasFactory, SoftDeletes;

    protected $table = 'officer_endorsements';

    protected $fillable = [
        'officer_id','hq_endorse_order_id','nothi_rcv_date','status',
    ];

    protected $casts = [
        'nothi_rcv_date' => 'date',
        'status' => 'integer',
    ];

    public function officer()
    {
        return $this->belongsTo(Officer::class);
    }

    public function endorseOrder()
    {
        return $this->belongsTo(HqEndorseOrder::class, 'hq_endorse_order_id');
    }

    public function fieldOfficeErs()
    {
        return $this->hasMany(FieldOfficeEr::class, 'endorsement_id');
    }
}
