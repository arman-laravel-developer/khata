<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public function userAdd()
    {
        return $this->belongsTo(User::class, 'add_by');
    }
    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'update_by');
    }
}
