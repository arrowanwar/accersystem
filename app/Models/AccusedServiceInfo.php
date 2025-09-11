<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccusedServiceInfo extends Model
{
  use HasFactory;

    protected $table = 'accused_service_infos';

    protected $fillable = [
        'name','post','office_full_name','office_short_name','thana','district'
    ];
}
