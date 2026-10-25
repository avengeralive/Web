<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
	use Notifiable;
	protected $fillable = [
        'phone', 'code'
    ];
    //
	public function routeNotificationForSmscru()
	{
		return $this->phone;
	}
}
