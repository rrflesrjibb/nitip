<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Member extends Model
{
    use HasFactory;
    protected $table = 'tbl_member';

    protected $fillable = [
        'kode_member',
        'name',
        'email',
        'telepon',
        'alamat',
        'password',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
}
