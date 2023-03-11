<?php

namespace App\Http\Controllers\Admin;

use App\Models\SpHoSoFilter;
use App\Models\SpHoSo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    /**
     * Search Ho So
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function hoso(Request $request)
    {
        $hoso = new SpHoSo();
        
        $hoso = $hoso->leftJoin('sp', 'sp.id', '=', 'sp_hoso.id_sp')
            ->leftJoin('dm_hc_xa', 'sp.dm_hc_xa', '=', 'dm_hc_xa.id')
            ->leftJoin('dm_hc_huyen', 'dm_hc_xa.dm_hc_huyen', '=', 'dm_hc_huyen.id')
            ->leftJoin('dm_hc_tinh', 'dm_hc_huyen.dm_hc_tinh', '=', 'dm_hc_tinh.id')
        ;
        
        /* Apply filter if post */
        $spHoSoFilter = new SpHoSoFilter();
        
        $spFilterCriteria = $spHoSoFilter->get();
    
        /* Apply filter */
        $hoso = $spHoSoFilter->apply($hoso, 'sp_hoso.');
        
        $hoso = $hoso->select(['sp_hoso.*', 'sp.ten', 'sp.giatri', 'sp.dm_loai_bds', 'sp.dm_kieu_bds']);
        
        $hoso = $hoso->orderBy('sp_hoso.id', 'DESC');

        return view('admin.search.hoso', [
            'hoso' => $hoso->paginate(20),
            'spFilterCriteria' => $spFilterCriteria,
        ]);
    }
    
    
    /**
     * Store filter criteria to session
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hosoFilter(Request $request)
    {
        $spFilter = new SpHoSoFilter();
        $spFilter->set($request->all());
        
        return redirect()->route('admin.search.hoso');
    }
    
    
    public function quanhday()
    {
        return view('admin.search.quanhday');
    }
    
    
    public function quanhdayResult(Request $request)
    {
        $hoso = new SpHoSo();
    
        $hoso = $hoso->leftJoin('sp', 'sp.id', '=', 'sp_hoso.id_sp')
            ->leftJoin('dm_hc_xa', 'sp.dm_hc_xa', '=', 'dm_hc_xa.id')
            ->leftJoin('dm_hc_huyen', 'dm_hc_xa.dm_hc_huyen', '=', 'dm_hc_huyen.id')
            ->leftJoin('dm_hc_tinh', 'dm_hc_huyen.dm_hc_tinh', '=', 'dm_hc_tinh.id')
            ->leftJoin('dm_hc_duong', 'sp.dm_hc_duong', '=', 'dm_hc_duong.id')
            ->leftJoin(DB::raw('(SELECT id_sp_hoso, path FROM sp_hoso_anh ORDER BY id DESC LIMIT 1 OFFSET 0) anh'), 'anh.id_sp_hoso', '=', 'sp_hoso.id')
        ;
    
        /* Apply filter if post */
        $spHoSoFilter = new SpHoSoFilter('admin.hoso.quanhday');
        $spHoSoFilter->set($request->all());
    
        $spFilterCriteria = $spHoSoFilter->get();
    
        /* Apply filter */
        $hoso = $spHoSoFilter->apply($hoso, 'sp_hoso.');
    
        $hoso = $hoso->select([
            'sp_hoso.id', 'sp_hoso.vt_latitude', 'sp_hoso.vt_longtitude',
            'sp.ten', 'sp.giatri', 'sp.dm_loai_bds', 'sp.dm_kieu_bds', 'sp.diachi',
            'anh.path',
            'dm_hc_tinh.giatri as ten_tinh',
            'dm_hc_huyen.giatri as ten_huyen',
            'dm_hc_xa.giatri as ten_xa',
            'dm_hc_duong.giatri as ten_duong',
            DB::raw("ST_Distance(
                ST_SetSRID( ST_MakePoint(sp_hoso.vt_longtitude, sp_hoso.vt_latitude)::geography, 4326 ),
                ST_SetSRID( ST_MakePoint(" . $spFilterCriteria['longtitude'] . ", " . $spFilterCriteria['latitude'] . ")::geography, 4326 )
            ) as khoang_cach")
        ]);
        
        /*DB::enableQueryLog();*/
        $result = $hoso->get();
        /*var_dump($spFilterCriteria);*/
        /*var_dump(DB::getQueryLog());*/
        return response()->json($result);
    }
}
