<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assessment extends Model {

    protected $casts = [
        'data' => 'object'
    ];

}
