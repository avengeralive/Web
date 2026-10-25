<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
	
	public function managedUsers() {
		return $this->hasMany('App\User', 'manager_id');
    }
		
	public function manager() {
		return $this->belongsTo('App\User', 'manager_id');
    }
	
	public function roles() {
		return $this->belongsToMany('App\Role','role_user');
    }
	
	public function investments() {
		return $this->hasMany('App\Investment');
	}
	public function gravatar($s = 250) {
		return $this->get_gravatar($this->email, $s);
	}
	
	/**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 512 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    	$url = 'https://www.gravatar.com/avatar/';
    	$url .= md5( strtolower( trim( $email ) ) );
    	$url .= "?s=$s&d=$d&r=$r";
    	if ( $img ) {
    		$url = '<img src="' . $url . '"';
    		foreach ( $atts as $key => $val )
    			$url .= ' ' . $key . '="' . $val . '"';
    		$url .= ' />';
    	}
    	return $url;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'work', 'post', 'city', 'before', 'experience', 'companyname', 'investmentfrom', 'investmentto', 'manager_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	/**
	* @param string|array $roles
	*/
	public function authorizeRoles($roles) {
		if (is_array($roles)) {
			return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized.');
		}
		return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
	}
	
	/**
	* Check multiple roles
	* @param array $roles
	*/
	public function hasAnyRole($roles)
	{
		return null !== $this->roles()->whereIn('name', $roles)->first();
	}
	
	/**
	* Check one role
	* @param string $role
	*/
	public function hasRole($role)
	{
		return null !== $this->roles()->where('name', $role)->first();
	}
}
