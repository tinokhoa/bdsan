<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpHoSoNhaKienTruc extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sp_hoso_nha_kientruc';
	
	
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
	
	/**
	 * Get dm_ket_cau.
	 */
	public function DmKetCau()
	{
		return $this->belongsTo('App\Models\DmKetCau', 'dm_ketcau', 'id');
	}
}
