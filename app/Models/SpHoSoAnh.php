<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpHoSoAnh extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sp_hoso_anh';
	
	
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
	 * Get dm_loai_anh.
	 */
	public function DmLoaiAnh()
	{
	    if (!empty($this->dm_loai_anh)) {
            return $this->belongsTo('App\Models\DmLoaiAnh', 'dm_loai_anh', 'id');
        } else {
	        return null;
        }
	}
}
