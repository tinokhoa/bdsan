<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Sp;
use App\Models\SpHoSo;
use App\Models\SpHoSoNhaKienTruc;
use App\Models\SpHoSoDat;
use App\Models\SpHoSoAnh;
use App\Models\SpHoSoTep;
use App\Models\SpFilter;
use App\Helpers\Permission;

class BdsController extends Controller
{
    /**
     * Show list
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        Permission::has('R_LIST', true);
        
        /* Create Sp instance */
        $sp = new Sp();
        
        $sp = $sp->leftJoin('dm_hc_xa', 'sp.dm_hc_xa', '=', 'dm_hc_xa.id')
            ->leftJoin('dm_hc_huyen', 'dm_hc_xa.dm_hc_huyen', '=', 'dm_hc_huyen.id')
            ->leftJoin('dm_hc_tinh', 'dm_hc_huyen.dm_hc_tinh', '=', 'dm_hc_tinh.id');
        
        /* Get Filter*/
        $spFilter = new SpFilter();
        $spFilterCriteria = $spFilter->get();
    
        /* Apply filter */
        $sp = $spFilter->apply($sp, 'sp.');
        
        $sp = $sp->select(['sp.*'])->orderBy('sp.created_at', 'DESC');
    
        /* Render view */
        return view('admin.bds.index', [
            'sp' => $sp->paginate(20),
            'spFilterCriteria' => $spFilterCriteria,
            'priceRanges' => $spFilter->getPriceRanges(),
        ]);
    }
    
    
    /**
     * Store filter criteria to session
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function indexFilter(Request $request)
    {
        Permission::has('R_LIST', true);
        
        $spFilter = new SpFilter();
        $spFilter->set($request->all());

        return redirect()->route('admin.re');
    }
    
    
	/**
	 * @param $id
	 * @return Sp
	 */
	private function findSp($id)
	{
		if (empty($id)) {
			$sp = new Sp();
		}
		else {
			$sp = Sp::find($id);
			
			if (!$sp) {
				abort(404, 'Không tìm thấy Sản phẩm #' . $id);
			}
		}
		
		return $sp;
	}
	
	
	/**
	 * @param $id
	 * @return SpHoSo
	 */
	private function findSpHoSo($id)
	{
		if (empty($id)) {
			$sp = new SpHoSo();
		}
		else {
			$sp = SpHoSo::find($id);
			
			if (!$sp) {
				abort(404, 'Không tìm thấy Sản phẩm #' . $id);
			}
		}
		
		return $sp;
	}
    
    
    /**
     * Remove colons from number fields
     *
     * @param $data
     * @return mixed
     */
	private function fixData($data)
	{
		$data['sp_giatri']              = str_replace(',', '', $data['sp_giatri']);
		$data['vt_somattien']           = str_replace(',', '', $data['vt_somattien']);
		$data['vt_logioihienhuu']       = str_replace(',', '', $data['vt_logioihienhuu']);
		$data['vt_logioiquyhoach']      = str_replace(',', '', $data['vt_logioiquyhoach']);
		$data['vt_longtitude']          = str_replace(',', '', $data['vt_longtitude']);
		$data['vt_latitude']            = str_replace(',', '', $data['vt_latitude']);
		$data['nha_dtxd']               = str_replace(',', '', $data['nha_dtxd']);
		$data['nha_dtsd']               = str_replace(',', '', $data['nha_dtsd']);
		$data['nha_chatluongconlai']    = str_replace(',', '', $data['nha_chatluongconlai']);
		$data['nha_giaxaydung']         = str_replace(',', '', $data['nha_giaxaydung']);
		$data['nha_sotang']             = str_replace(',', '', $data['nha_sotang']);
		$data['nha_phongkhach']         = str_replace(',', '', $data['nha_phongkhach']);
		$data['nha_phongngu']           = str_replace(',', '', $data['nha_phongngu']);
		$data['nha_phongwc']            = str_replace(',', '', $data['nha_phongwc']);
		$data['nha_namxaydung']         = str_replace(',', '', $data['nha_namxaydung']);
		$data['dat_ngang']              = str_replace(',', '', $data['dat_ngang']);
		$data['dat_dai']                = str_replace(',', '', $data['dat_dai']);
		$data['dat_nohau']              = str_replace(',', '', $data['dat_nohau']);
		$data['dat_tongdientich']       = str_replace(',', '', $data['dat_tongdientich']);
		$data['kl_dongia']              = str_replace(',', '', $data['kl_dongia']);
		
		return $data;
	}
	
	
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function save(Request $request)
	{
		$data = $request->all();
		$data = $this->fixData($data);
        
        if (empty($data['id'])) {
            Permission::has('R_ADD', true);
        }
        else {
            Permission::has('R_EDIT', true);
        }
		
		if (!empty($data['return'])) {
            $return = $data['return'];
            unset($data['return']);
        } else {
		    $return = null;
        }
		
		$sp = $this->findSp($data['id']);
		$sp_hoso = $this->findSpHoSo($data['id_hoso']);
		
		unset(  $data['id'],
				$data['id_hoso'],
				$data['_token']);
		
		/*
		 |--------------------------------------------------------
		 |-- Save sp
		 |--------------------------------------------------------
		 */
		
		$sp->ten            = $data['sp_ten'];
		$sp->dm_loai_bds    = $data['sp_dm_loai_bds'];
		$sp->dm_kieu_bds    = $data['sp_dm_kieu_bds'];
		$sp->giatri         = $data['sp_giatri'];
		$sp->diachi         = $data['sp_diachi'];
		$sp->dm_hc_duong    = $data['sp_dm_hc_duong'];
		$sp->dm_hc_xa       = $data['sp_dm_hc_xa'];
		$sp->noidung        = '&nbsp;';
		
		try {
			$sp->save();
		}
		catch (\Exception $ex) {
			Session::flash('flash-error', htmlentities($ex->getMessage()));
			return redirect()->back()->withInput();
		}
		
		unset(  $data['sp_ten'],
				$data['sp_dm_loai_bds'],
				$data['sp_dm_kieu_bds'],
				$data['sp_giatri'],
				$data['sp_diachi'],
				$data['sp_dm_hc_duong'],
				$data['sp_dm_hc_xa'],
				$data['_wysihtml5_mode']);
        
        /*
         |--------------------------------------------------------
         |-- Save sp_hoso
         |--------------------------------------------------------
         */
		
		foreach ($data as $field => $value) {
			if (!is_array($value) && $value != null) {
				$sp_hoso->$field = $value;
				unset($data[$field]);
			}
		}
		
		$sp_hoso->id_sp = $sp->id;
		
		try {
			$sp_hoso->save();
		}
		catch (\Exception $ex) {
			Session::flash('flash-error', htmlentities($ex->getMessage()));
			return redirect()->back()->withInput();
		}
        
        /*
         |--------------------------------------------------------
         |-- Save sp_hoso_nha_kientruc
         |--------------------------------------------------------
         */
		
		SpHoSoNhaKienTruc::where('id_sp_hoso', $sp_hoso->id)->delete();
		
		if (!empty($data['nha_kt_dm_ketcau'])) {
            foreach ($data['nha_kt_dm_ketcau'] as $key => $val) {
                $item = new SpHoSoNhaKienTruc();
                
                $item->id_sp_hoso = $sp_hoso->id;
                $item->dm_ketcau = $data['nha_kt_dm_ketcau'][$key];
                $item->loai = $data['nha_kt_loai'][$key];
                $item->hientrang = $data['nha_kt_hientrang'][$key];
                $item->chatluong = str_replace('%', '', $data['nha_kt_chatluong'][$key]);
                
                try {
                    $item->save();
                } catch (\Exception $ex) {
                    Session::flash('flash-error', htmlentities($ex->getMessage()));
                    return redirect()->back()->withInput();
                }
            }
        }
        
        /*
         |--------------------------------------------------------
         |-- Save sp_hoso_dat
         |--------------------------------------------------------
         */
        
        SpHoSoDat::where('id_sp_hoso', $sp_hoso->id)->delete();
        
        if (!empty($data['dat_ct_loaidat'])) {
            foreach ($data['dat_ct_loaidat'] as $key => $val) {
                $item = new SpHoSoDat();
        
                $item->id_sp_hoso = $sp_hoso->id;
                $item->loaidat = $data['dat_ct_loaidat'][$key];
                $item->dientich = str_replace(',', '', $data['dat_ct_dientich'][$key]);
                $item->giathamdinh = str_replace(',', '', $data['dat_ct_giathamdinh'][$key]);
                $item->tinhgia = str_replace(',', '', $data['dat_ct_tinhgia'][$key]);
                $item->ghichu = $data['dat_ct_ghichu'][$key];
        
                try {
                    $item->save();
                } catch (\Exception $ex) {
                    Session::flash('flash-error', htmlentities($ex->getMessage()));
                    return redirect()->back()->withInput();
                }
            }
        }
        
        /* Show success message */
		
		Session::flash('flash-success', 'Sản phẩm ' . $sp->ten . ' đã được lưu lại');
		
		if ($return) {
		    return redirect()->to($return);
        } else {
            return redirect()->route('admin.re.edit', ['id' => $sp_hoso->id]);
        }
	}
	
	
	public function delete($id_sp)
    {
        $sp = Sp::find($id_sp);
        
        if ($sp) {
            $hoso = $sp->SpHoSo()->get();
    
            foreach ($hoso as $hs) {
                $this->deleteHoSo($hs->id);
            }
    
            $sp->SpHoSo()->first()->delete();
            $sp->delete();
    
            return redirect()->route('admin.re');
        }
        else {
            abort('404', 'Không tìm thấy sản phẩm #' . $id_sp);
        }
    }
    
    
    /**
     * @param $id_sp
     * @return \Illuminate\Http\RedirectResponse
     */
	public function createHoSo($id_sp)
    {
        Permission::has('R_PROFILE_ADD', true);
        
        $sp_hoso = new SpHoSo();
        
        $sp_hoso->id_sp = $id_sp;
        $sp_hoso->save();
        
        return redirect()->route('admin.re.edit', ['id' => $sp_hoso->id]);
    }
    
    
    /**
     * @param $id_sp_hoso
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteHoSo($id_sp_hoso)
    {
        $hoso = SpHoSo::find($id_sp_hoso);
        
        if ($hoso) {
            SpHoSoAnh::where('id_sp_hoso', '=', $id_sp_hoso)->delete();
            SpHoSoTep::where('id_sp_hoso', '=', $id_sp_hoso)->delete();
            SpHoSoNhaKienTruc::where('id_sp_hoso', '=', $id_sp_hoso)->delete();
            SpHoSoDat::where('id_sp_hoso', '=', $id_sp_hoso)->delete();
            
            $sp = Sp::find($hoso->id_sp);
            $hoso->delete();
            
            if ($sp->SpHoSo()->count() == 0) {
                return $this->createHoSo($sp->id);
            }
            else {
                $hoso = $sp->SpHoSo()->orderBy('id', 'DESC')->first();
    
                return redirect()->route('admin.re.edit', ['id' => $hoso->id]);
            }
        }
        else {
            return redirect()->route('admin.re');
        }
    }
	
	
	/**
	 * Show Add form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function formAdd()
    {
        Permission::has('R_ADD', true);
        
    	return view('admin.bds.form', [
    		'sp' => new Sp(),
		    'sp_hoso' => new SpHoSo(),
	    ]);
    }
	
    
	/**
	 * Show Add form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function formEdit($id)
    {
        if (!Permission::has('R_EDIT') && !Permission::has('R_PROFILE_VIEW')) {
            Permission::throwError('R_PROFILE_VIEW');
        }
        
        $sp_hoso = $this->findSpHoSo($id);
        
        if (!$sp_hoso->id) {
            abort(404, 'Không tìm thấy hồ sơ #' . $id);
        }
        
        $sp = $sp_hoso->Sp()->first();
    	
        return view('admin.bds.form', [
    		'sp' => $sp,
		    'sp_hoso' => $sp_hoso,
	    ]);
    }
    
    
    /**
     * Handle image AJAX upload
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(Request $request, $id)
    {
        Permission::has('R_ADD', true) || Permission::has('R_EDIT', true);
        
        $result = [
            'status' => 200,
            'message' => 'Đã tải tệp thành công',
            'data' => [],
        ];
        
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $type = $request->get('type');
            
            foreach ($files as $file) {
                if ($file->isValid()) {
                    if ($type == 'img') {
                        $newImage =  $file->store($id, 'bds');
                        $item = new SpHoSoAnh();
                    }
                    else {
                        $newImage =  $file->storeAs($id, time() . '_' . $file->getClientOriginalName(), 'bds');
                        $item = new SpHoSoTep();
                    }
    
                    $newImage = str_replace($id . '/', '', $newImage);
                    $item->id_sp_hoso = $id;
                    $item->path = $newImage;
                    $item->save();
                    
                    $result['data'][] =  $newImage;
                }
            }
        }
        
        return response()->json($result);
    }
    
    
    /**
     * Handle AJAX delete image & file
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFile(Request $request)
    {
        Permission::has('R_ADD', true) || Permission::has('R_EDIT', true);
        
        $result = [
            'status' => 200,
            'message' => 'Đã xoá tệp thành công',
        ];
        
        $file = $request->post('path');
        $type = $request->post('type');
        $id_sp_hoso = $request->post('id_sp_hoso');
        
        if ($type == 'img') {
            $fromDb = SpHoSoAnh::where(['path' => $file, 'id_sp_hoso' => $id_sp_hoso]);
        } else {
            $fromDb = SpHoSoTep::where(['path' => $file, 'id_sp_hoso' => $id_sp_hoso]);
        }
        
        if ($fromDb) {
            $fromDb->delete();
            $filePath = config('filesystems.disks.bds.root') . '/' . $id_sp_hoso . '/' . $file;
            
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        return response()->json($result);
    }
}
