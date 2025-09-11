<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Officer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'officers';

    protected $fillable = ['name','joint_current_office_date'];

    protected $casts = [ 'joint_current_office_date' => 'date' ];

    public function endorsements()
    {
        return $this->hasMany(OfficerEndorsement::class);
    }
}
