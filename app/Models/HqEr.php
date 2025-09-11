<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class HqEr extends Model
{
       use HasFactory, SoftDeletes;

    protected $table = 'hq_ers';

    protected $fillable = [
        'hq_er_no','date','section','nothi_no','code',
    ];

    protected $casts = [
        'date' => 'date',
        'section' => 'integer',
        'code' => 'integer',
    ];

    public function endorseOrders()
    {
        return $this->hasMany(HqEndorseOrder::class);
    }

    public function fieldOfficeErs()
    {
        return $this->hasMany(FieldOfficeEr::class, 'hq_er_no', 'hq_er_no');
    }
}
