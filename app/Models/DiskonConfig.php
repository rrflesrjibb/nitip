<?php

// app/Models/DiskonConfig.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiskonConfig extends Model
{
    protected $fillable = ['minimum_pembelian', 'diskon'];
}
