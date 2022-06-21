<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllTest extends Model
{
    use HasFactory;

    protected $table = 'all_test';
    protected $primaryKey = 'id';

    public $timestamps = false;
}