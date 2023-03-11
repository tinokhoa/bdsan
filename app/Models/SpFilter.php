<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;

class SpFilter
{
    private $_sessionKey = 'admin.sp.filter';
    
    private $_filter = [
        'ten' => null,
        'giatri' => null,
        'dm_loai_bds' => null,
        'dm_hc_tinh' => null,
        'dm_hc_huyen' => null,
        'dm_hc_xa' => null,
    ];
    
    
    private $_priceRanges = [
        1 => ['min' => null,    'max' => 200,   'unitMin' => '',    'unitMax' => 'tr'],
        2 => ['min' => 200,     'max' => 400,   'unitMin' => 'tr',  'unitMax' => 'tr'],
        3 => ['min' => 400,     'max' => 600,   'unitMin' => 'tr',  'unitMax' => 'tr'],
        4 => ['min' => 600,     'max' => 1,     'unitMin' => 'tr',  'unitMax' => 'tỷ'],
        5 => ['min' => 1,       'max' => null,  'unitMin' => 'tỷ',  'unitMax' => ''],
    ];
    
    
    /**
     * SpFilter constructor.
     */
    public function __construct()
    {
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
    
            Session::put($this->_sessionKey, $this->_filter);
        }
        
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
        if ($this->_filter['ten'] !== null) {
            $sp = $sp->where($fieldsPrefix . 'ten', 'LIKE', '%' . $this->_filter['ten'] . '%');
        }
    
        if ($this->_filter['giatri'] !== null) {
            $ranges = $this->getPriceRanges(true);
        
            if (isset($ranges[$this->_filter['giatri']])) {
                $range = $ranges[$this->_filter['giatri']];
            
                if ($range['min'] !== null) {
                    $sp = $sp->where($fieldsPrefix . 'giatri', '>=', $range['min']);
                }
            
                if ($range['max'] !== null) {
                    $sp = $sp->where($fieldsPrefix . 'giatri', '<=', $range['max']);
                }
            }
        }
    
        if ($this->_filter['dm_loai_bds'] !== null) {
            $sp = $sp->where($fieldsPrefix . 'dm_loai_bds', '=', $this->_filter['dm_loai_bds']);
        }
    
        if ($this->_filter['dm_hc_tinh'] !== null) {
            $sp = $sp->where('dm_hc_tinh.id', '=', $this->_filter['dm_hc_tinh']);
        }
    
        if ($this->_filter['dm_hc_huyen'] !== null) {
            $sp = $sp->where('dm_hc_huyen.id', '=', $this->_filter['dm_hc_huyen']);
        }
    
        if ($this->_filter['dm_hc_xa'] !== null) {
            $sp = $sp->where($fieldsPrefix . 'dm_hc_xa', '=', $this->_filter['dm_hc_xa']);
        }
        
        return $sp;
    }
    
    
    /**
     * @param $value
     * @param $unit
     * @return float|int|null
     */
    private function getPrice($value, $unit)
    {
        if ($value == null) {
            return null;
        }
        elseif (empty($unit)) {
            return $value;
        }
        else {
            if ($unit == 'tr') {
                return $value * 1000000;
            }
            elseif ($unit == 'tỷ') {
                return $value * 1000000000;
            }
        }
    }
    
    /**
     * Get filter price ranges
     *
     * @return array
     */
    public function getPriceRanges($isInt = false)
    {
        if ($isInt) {
            $ranges = $this->_priceRanges;
            $newRages = [];
            
            foreach ($ranges as $key => $range) {
                $newRages[$key] = [
                    'min' => $this->getPrice($range['min'], $range['unitMin']),
                    'max' => $this->getPrice($range['max'], $range['unitMax']),
                ];
            }
            
            return $newRages;
        } else {
            return $this->_priceRanges;
        }
    }
}