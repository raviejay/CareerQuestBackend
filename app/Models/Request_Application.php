<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request_Application extends Model
{
    use HasFactory;

    protected $primaryKey = 'rapp_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'job_id',
        'Document',
        'status',
        'app_id'
    ];

    // public function applicantInfo()
    // {
    //     return $this->hasOne(Applicant_info::class, 'app_id'); // adjust the foreign key accordingly
    // }
    public function applicantInfo()
    {
        return $this->belongsTo(Applicant_Info::class, 'app_id', 'app_id');
    }
    
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'job_id');
    }
 
}
