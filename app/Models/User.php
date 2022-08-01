<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable
{
    use HasRoleAndPermission;
    use Notifiable;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
        'password',
        'remember_token',
        'activated',
        'token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'paynumber',
        'first_name',
        'last_name',
        'email',
        'location',
        'ip_address',
        'department',
        'position',
        'mobile',
        'backable',
        'password',
        'password_changed',
        'pwd_last_changed',
        'activated',
        'token',
        'signup_ip_address',
        'signup_confirmation_ip_address',
        'signup_sm_ip_address',
        'admin_ip_address',
        'updated_ip_address',
        'deleted_ip_address',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                                => 'integer',
        'name'                              => 'string',
        'paynumber'                         => 'string',
        'first_name'                        => 'string',
        'last_name'                         => 'string',
        'email'                             => 'string',
        'location'                          => 'string',
        'ip_address'                        => 'string',
        'department'                        => 'string',
        'position'                          => 'string',
        'mobile'                            => 'string',
        'backable'                          => 'string',
        'password'                          => 'string',
        'password_changed'                  => 'boolean',
        'pwd_last_changed'                  => 'string',
        'activated'                         => 'boolean',
        'token'                             => 'string',
        'signup_ip_address'                 => 'string',
        'signup_confirmation_ip_address'    => 'string',
        'signup_sm_ip_address'              => 'string',
        'admin_ip_address'                  => 'string',
        'updated_ip_address'                => 'string',
        'deleted_ip_address'                => 'string',
    ];

    /**
     * Get the socials for the user.
     */
    public function social()
    {
        return $this->hasMany('App\Models\Social');
    }

    /**
     * Get the profile associated with the user.
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    /**
     * The profiles that belong to the user.
     */
    public function profiles()
    {
        return $this->belongsToMany('App\Models\Profile')->withTimestamps();
    }

    /**
     * Check if a user has a profile.
     *
     * @param  string  $name
     *
     * @return bool
     */
    public function hasProfile($name)
    {
        foreach ($this->profiles as $profile) {
            if ($profile->name === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add/Attach a profile to a user.
     *
     * @param  Profile $profile
     */
    public function assignProfile(Profile $profile)
    {
        return $this->profiles()->attach($profile);
    }

    /**
     * Remove/Detach a profile to a user.
     *
     * @param  Profile $profile
     */
    public function removeProfile(Profile $profile)
    {
        return $this->profiles()->detach($profile);
    }

    public function asset(){
        return $this->hasMany('App\Models\Asset', 'username', 'paynumber');
    }


}
