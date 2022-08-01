<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noncompliant extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'noncompliants';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that are hidden.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent',
        'ip_address',
        'department',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'agent'     => 'string',
        'ip_address'     => 'string',
        'department'          => 'string',
    ];
}