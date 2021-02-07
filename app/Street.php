<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    //
    protected $table = "streets";

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
