<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'user_id',
        'admin_id',
        'title',
        'description',
        'request_file_path',
        'response_file_path',
        'status',
        'submitted_at',
        'feedback',
    ];

    // Student who requested
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Admin who prepared
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
