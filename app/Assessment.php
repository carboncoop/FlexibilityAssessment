<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model {

    protected $casts = [
        'data' => 'object'
    ];

     /**
     * Get the user that owns the assessment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
