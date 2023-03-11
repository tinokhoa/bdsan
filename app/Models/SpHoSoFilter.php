<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SpHoSoFilter
{
    private $_sessionKey = 'admin.hoso.filter';
    
    private $_filter = [
        'dm_kieu_bds' => null,
        'dm_loai_bds' => null,
        'dm_hc_tinh' => null,
        'dm_hc_huyen' => null,
        'dm_hc_xa' => null,
        'dien_tich_min' => null,
        'dien_tich_max' => null,
        'nha_sotang' => null,
        'giatri' => null,
        'nha_chodexehoi' => null,
        'nha_phongwc' => null,
        'vt_logioihienhuu' => null,
        'so_diem' => null,
        'pham_vi' => null,
        'longtitude' => null,
        'latitude' => null,
        'sap_xep' => null,
    ];
    
    
    /**
     * SpHoSoFilter constructor.
     * @param string $sessionKey
     */
    public function __construct($sessionKey = 'admin.hoso.filter')
    {
        $this->_sessionKey = $sessionKey;
        $this->set(Session::get($this->_sessionKey));
    }
    
    
    /**
     * @param $options
     * @return array
     */
    public function set($options)
    {
        if (is_array($options)) {
            $keys = array_keys($this->_filter);
    
            foreach ($options as $key => $value) {
                if (in_array($key, $keys)) {
                    $this->_filter[$key] = $value;
                }
            }
        }
        
        if ($this->_filter['dien_tich_min'] !== null) {
            $this->_filter['dien_tich_min'] = str_replace(',', '', $this->_filter['dien_tich_min']);
        }
        
        if ($this->_filter['dien_tich_max'] !== null) {
            $this->_filter['dien_tich_max'] = str_replace(',', '', $this->_filter['dien_tich_max']);
        }
        
        if ($this->_filter['so_diem'] !== null) {
            $this->_filter['so_diem'] = max($this->_filter['so_diem'], 0);
        }
        
        if ($this->_filter['latitude'] !== null) {
            $this->_filter['latitude'] = doubleval($this->_filter['latitude']);
        }
        
        if ($this->_filter['longtitude'] !== null) {
            $this->_filter['longtitude'] = doubleval($this->_filter['longtitude']);
        }
        
        if ($this->_filter['pham_vi'] !== null) {
            $this->_filter['pham_vi'] = max($this->_filter['pham_vi'], 0);
        }
    
        Session::put($this->_sessionKey, $this->_filter);
        
        return $this->get();
    }
    
    
    /**
     * Get filter options
     *
     * @return array
     */
    public function get()
    {
        return $this->_filter;
    }
    
    
    /**
     * Apply filter
     *
     * @param \App\Models\Sp $sp
     * @param $fieldsPrefix
     * @return \App\Models\Sp
     */
    public function apply($sp, $fieldsPrefix)
    {
        if ($this->_filter['dm_kieu_bds'] !== null) {
            $sp = $sp->where('sp.dm_kieu_bds', '=', $this->_filter['dm_kieu_bds']);
        }
        
        if ($this->_filter['dm_loai_bds'] !== null) {
            $sp = $sp->where('sp.dm_loai_bds', '=', $this->_filter['dm_loai_bds']);
        }
    
        if ($this->_filter['dm_hc_tinh'] !== null) {
            $sp = $sp->where('dm_hc_tinh.id', '=', $this->_filter['dm_hc_tinh']);
        }
    
        if ($this->_filter['dm_hc_huyen'] !== null) {
            $sp = $sp->where('dm_hc_huyen.id', '=', $this->_filter['dm_hc_huyen']);
        }
    
        if ($this->_filter['dm_hc_xa'] !== null) {
            $sp = $sp->where('sp.dm_hc_xa', '=', $this->_filter['dm_hc_xa']);
        }
    
        if ($this->_filter['dien_tich_min'] !== null) {
            $sp = $sp->where('sp_hoso.dat_tongdientich', '>=', $this->_filter['dien_tich_min']);
        }
    
        if ($this->_filter['dien_tich_max'] !== null) {
            $sp = $sp->where('sp_hoso.dat_tongdientich', '<=', $this->_filter['dien_tich_max']);
        }
    
        if ($this->_filter['giatri'] !== null) {
            $sp = $sp->where('sp.giatri', '>=', $this->_filter['giatri'] * 1000000);
        }
    
        if ($this->_filter['nha_chodexehoi'] !== null) {
            $sp = $sp->where('sp_hoso.nha_chodexehoi', '=', $this->_filter['nha_chodexehoi']);
        }
    
        if ($this->_filter['nha_phongwc'] !== null) {
            $sp = $sp->where('sp_hoso.nha_phongwc', '>=', $this->_filter['nha_phongwc']);
        }
    
        if ($this->_filter['vt_logioihienhuu'] !== null) {
            $sp = $sp->where('sp_hoso.vt_logioihienhuu', '>=', $this->_filter['vt_logioihienhuu']);
        }
    
        if ($this->_filter['pham_vi'] !== null
            && $this->_filter['longtitude'] !== null
            && $this->_filter['latitude'] !== null)
        {
            /* This function require PostGis extension, please install this first */
            /* https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-postgis-on-ubuntu-14-04 */
            $sp = $sp->whereNotNull('sp_hoso.vt_longtitude');
            $sp = $sp->whereNotNull('sp_hoso.vt_latitude');
            
            $sp = $sp->whereRaw("ST_DWithin(
                ST_SetSRID(ST_MakePoint(sp_hoso.vt_longtitude, sp_hoso.vt_latitude)::geography, 4326),
                ST_SetSRID(ST_MakePoint(" . $this->_filter['longtitude'] . ", " . $this->_filter['latitude'] . ")::geography, 4326)
            , " . $this->_filter['pham_vi'] . ")");
        }
    
        if ($this->_filter['sap_xep'] !== null) {
            switch ($this->_filter['sap_xep']) {
                case 'price-desc':
                    $sp = $sp->orderBy('sp.giatri', 'DESC');
                    break;
                    
                case 'price-asc':
                    $sp = $sp->orderBy('sp.giatri', 'ASC');
                    break;
                    
                case 'oldest':
                    $sp = $sp->orderBy('sp_hoso.created_at', 'ASC');
                    break;
                    
                default:
                case 'newest':
                    $sp = $sp->orderBy('sp_hoso.created_at', 'DESC');
                    break;
            }
        }
    
        if ($this->_filter['so_diem'] !== null) {
            $sp = $sp->take($this->_filter['so_diem']);
        }
        
        return $sp;
    }
}