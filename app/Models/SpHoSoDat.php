<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpHoSoDat extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sp_hoso_dat';
	
	
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
	
	
	/**
	 * Get sp_hoso.
	 */
	public function SpHoSo()
	{
		return $this->belongsTo('App\Models\SpHoSo', 'id_sp_hoso', 'id');
	}
}
