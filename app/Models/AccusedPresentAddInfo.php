<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccusedPresentAddInfo extends Model
{
    //
        use HasFactory;

    protected $table = 'accused_present_add_infos';

    protected $fillable = ['text','thana','district'];
}
