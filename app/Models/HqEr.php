<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class HqEr extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hq_ers';
    protected $fillable = ['hq_er_id'];

    /**
     * Get the Endorse Orders associated with the HQ ER.
     */
    public function endorseOrders(): HasMany
    {
        return $this->hasMany(HqEndorseOrder::class, 'hq_er_id');
    }

    /**
     * Get the Field Office ERs associated with the HQ ER.
     */
    public function fieldOfficeErs(): HasMany
    {
        return $this->hasMany(FieldOfficeEr::class, 'hq_er_id');
    }

    /**
     * A more complex relationship to get all Officers endorsed on this HQ ER
     * through the HqEndorseOrder and OfficerEndorsement tables.
     */
    public function endorsedOfficers(): HasManyThrough
    {
        return $this->hasManyThrough(
            Officer::class,
            OfficerEndorsement::class,
            'hq_er_id', // Foreign key on the intermediate table (OfficerEndorsement)
            'id', // Foreign key on the final table (Officer)
            'id', // Local key on the current model (HqEr)
            'officer_id' // Local key on the intermediate table (OfficerEndorsement) that points to Officer
        );
    }
}
