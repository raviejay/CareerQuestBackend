<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer_Info extends Model
{
    use HasFactory;

    protected $primaryKey = 'emp_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Fname',
        'Lname',
        'Email',
        'acce_id',
    ];

    public function EmployerAcc()
    {
        return $this->belongsTo(Employer_Acc_Acc::class, 'acce_id');
    }

}
