<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'company_logo',
        'company_name',
        'company_code',
        'company_email',
        'company_phone',
        'company_address',
        'company_city',
        'company_state',
        'company_zip',
        'company_country',
        'company_website',
        'status',
    ];

    // Accessor to get status as 'Active' or 'Inactive'
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }

    // Optional: Mutator to always store status as 0 or 1
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == 'Active' || $value == 1) ? 1 : 0;
    }
}
