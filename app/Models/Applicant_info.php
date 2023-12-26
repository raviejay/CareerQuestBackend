<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant_info extends Model
{
    use HasFactory;

    protected $primaryKey = 'app_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Fname',
        'Lname',
        'Age',
        'Gender',
        'Email',
        'Address',
        'Birth_date',
        'acc_id',
    ];

   /**
     * Define the relationship with Applicant_Acc model.
     */
    public function applicantAcc()
    {
        return $this->belongsTo(Applicant_Acc::class, 'acc_id');
    }

    /**
     * Define the relationship with Request_Application model.
     */
    public function requestApplications()
    {
        return $this->hasMany(Request_Application::class, 'app_id');
    }


}
