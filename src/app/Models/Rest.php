<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $dates = ['break_in', 'break_out'];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
