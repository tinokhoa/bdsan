<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmHcTinh extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'dm_hc_tinh';
	
	
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
	
	
	/**
	 * Get childs.
	 */
	public function DmHcHuyen()
	{
		return $this->hasMany('App\Models\DmHcHuyen', 'dm_hc_huyen');
	}
}
