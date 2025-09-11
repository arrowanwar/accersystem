<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldOfficeEr extends Model
{
    use HasFactory;

    protected $table = 'field_office_ers';

    protected $fillable = [
        'hq_er_no','enq_officer_id','endorsement_id',
        'accused_service_info_id','accused_present_add_info_id','accused_permanent_add_info_id',
    ];

    public function hqEr()
    {
        return $this->belongsTo(HqEr::class, 'hq_er_no', 'hq_er_no');
    }

    public function enquiryOfficer()
    {
        return $this->belongsTo(Officer::class, 'enq_officer_id');
    }

    public function endorsement()
    {
        return $this->belongsTo(OfficerEndorsement::class, 'endorsement_id');
    }

    public function accusedServiceInfo()
    {
        return $this->belongsTo(AccusedServiceInfo::class);
    }

    public function accusedPresentAddress()
    {
        return $this->belongsTo(AccusedPresentAddInfo::class, 'accused_present_add_info_id');
    }

    public function accusedPermanentAddress()
    {
        return $this->belongsTo(AccusedPermanentAddInfo::class, 'accused_permanent_add_info_id');
    }
}
