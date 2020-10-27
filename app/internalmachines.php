<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class internalmachines extends Model
{
    public $table = 'internalmachines';
    
    // <!-- serial_number, name, type, specs -->


    //   use Notifiable;

    /**
     * The attributes that are mass assignable.
     *s
     * @var array
     */
    protected $fillable = [
        
        'serial_number', 'brand',  'model'
        
    ];

}
