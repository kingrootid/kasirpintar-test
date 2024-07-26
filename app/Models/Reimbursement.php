<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'name',
        'deskripsi',
        'attachment',
        'status'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
