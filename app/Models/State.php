<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'state_master';

    protected $fillable = [
        'name',
    ];

    public function list()
    {
        return $this->latest()->paginate(10);
    }
}
