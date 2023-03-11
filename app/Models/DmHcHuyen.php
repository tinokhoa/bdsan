<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmHcHuyen extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'dm_hc_huyen';
	
	
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
	
	
	/**
	 * Get childs.
	 */
	public function DmHcXa()
	{
		return $this->hasMany('App\Models\DmHcXa', 'dm_hc_huyen', 'id');
	}
	
	/**
	 * Get parent.
	 */
	public function DmHcTinh()
	{
		return $this->belongsTo('App\Models\DmHcTinh', 'dm_hc_tinh', 'id');
	}
}
