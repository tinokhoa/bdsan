<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Sp extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sp';
	
	
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = true;
	
	
	/**
	 * Get childs.
	 */
	public function SpHoSo()
	{
		return $this->hasMany('App\Models\SpHoSo', 'id_sp', 'id');
	}
	
	/**
	 * Get last child.
	 */
	public function SpHoSoLatest()
	{
		if ($this->id) {
		    return SpHoSo::where('id_sp', $this->id)->orderBy('id', 'DESC')->first();
        } else {
		    return new Collection();
        }
	}
	
	/**
	 * Get dm_loai_bds.
	 */
	public function DmLoaiBds()
	{
		return $this->belongsTo('App\Models\DmLoaiBds', 'dm_loai_bds', 'id');
	}
	
	/**
	 * Get dm_kieu_bds.
	 */
	public function DmKieuBds()
	{
		return $this->belongsTo('App\Models\DmKieuBds', 'dm_kieu_bds', 'id');
	}
	
	/**
	 * Get dm_hc_duong.
	 */
	public function DmHcDuong()
	{
		return $this->belongsTo('App\Models\DmHcDuong', 'dm_hc_duong', 'id');
	}
	
	/**
	 * Get dm_hc_xa.
	 */
	public function DmHcXa()
	{
		return $this->belongsTo('App\Models\DmHcXa', 'dm_hc_xa', 'id');
	}
}
