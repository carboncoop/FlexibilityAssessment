<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'telephone', 'address1','address2','postcode_zones', 'postcode', 'city_town', 'organisation_id'
    ];
    
     /**
     * Get the users associated with the organisation.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
    
}
