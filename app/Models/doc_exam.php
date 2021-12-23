<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doc_exam extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $fillable = [
        'doctor_Id',
        'examination_Id',
        'result'
    ];
}
