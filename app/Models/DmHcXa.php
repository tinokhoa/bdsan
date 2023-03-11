<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmHcXa extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'dm_hc_xa';
	
	
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
	
	
	/**
	 * Get parent.
	 */
	public function DmHcHuyen()
	{
		return $this->belongsTo('App\Models\DmHcHuyen', 'dm_hc_huyen');
	}
}
