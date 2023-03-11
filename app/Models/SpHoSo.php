<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpHoSo extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sp_hoso';
	
	
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = true;
	
	
	/**
	 * Get sp_hoso_anh.
	 */
	public function SpHoSoAnh()
	{
		return $this->hasMany('App\Models\SpHoSoAnh', 'id_sp_hoso');
	}
	
	/**
	 * Get sp_hoso_tep.
	 */
	public function SpHoSoTep()
	{
		return $this->hasMany('App\Models\SpHoSoTep', 'id_sp_hoso');
	}
	
	/**
	 * Get sp_hoso_nha_kientruc.
	 */
	public function SpHoSoNhaKienTruc()
	{
		return $this->hasMany('App\Models\SpHoSoNhaKienTruc', 'id_sp_hoso');
	}
	
	/**
	 * Get sp_hoso_dat.
	 */
	public function SpHoSoDat()
	{
		return $this->hasMany('App\Models\SpHoSoDat', 'id_sp_hoso');
	}
	
	/**
	 * Get sp.
	 */
	public function Sp()
	{
		return $this->belongsTo('App\Models\Sp', 'id_sp', 'id');
	}
	
	/**
	 * Get dm_hc_duong.
	 */
	public function DmHcDuong()
	{
		return $this->belongsTo('App\Models\DmHcDuong', 'dm_hc_duong', 'id');
	}
	
	/**
	 * Get dm_phap_ly.
	 */
	public function DmPhapLy()
	{
		return $this->belongsTo('App\Models\DmPhapLy', 'pl_dm_phap_ly', 'id');
	}
	
	/**
	 * Get dm_phap_ly_dat.
	 */
	public function DmPhapLyDat()
	{
		return $this->belongsTo('App\Models\DmPhapLyDat', 'pl_dm_phap_ly_dat', 'id');
	}
	
	/**
	 * Get dm_phap_ly_nha.
	 */
	public function DmPhapLyNha()
	{
		return $this->belongsTo('App\Models\DmPhapLyNha', 'pl_dm_phap_ly_nha', 'id');
	}
	
	/**
	 * Get dm_vlxd.
	 */
	public function DmVlxd()
	{
		return $this->belongsTo('App\Models\DmVlxd', 'nha_dm_vlxd', 'id');
	}
	
	/**
	 * Get dm_ha_tang.
	 */
	public function DmHaTang()
	{
		return $this->belongsTo('App\Models\DmHaTang', 'dg_dm_ha_tang', 'id');
	}
	
	/**
	 * Get dm_don_vi.
	 */
	public function DmDonVi()
	{
		return $this->belongsTo('App\Models\DmDonVi', 'tptd_dm_don_vi', 'id');
	}
	
	/**
	 * Get dm_don_vi.
	 */
	public function DmHuong()
	{
		return $this->belongsTo('App\Models\DmHuong', 'vt_huong', 'id');
	}
}
