<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Helpers\Permission;

class CategoryController extends Controller
{
	/**
	 * @var array
	 */
	private $category_list = [
		'dm_don_vi'         => [ 'name' => 'Đơn vị', 'desc' => '' ],
		'dm_ha_tang'        => [ 'name' => 'Hạ tầng', 'desc' => '' ],
		'dm_hc_duong'       => [ 'name' => 'Đường', 'desc' => '' ],
		'dm_hc_huyen'       => [ 'name' => 'Quận / Huyện', 'desc' => '' ],
		'dm_hc_tinh'        => [ 'name' => 'Tỉnh / Thành phố', 'desc' => '' ],
		'dm_hc_xa'          => [ 'name' => 'Xã / Phường', 'desc' => '' ],
		'dm_ket_cau'        => [ 'name' => 'Kết cấu', 'desc' => '' ],
		'dm_kieu_bds'       => [ 'name' => 'Kiểu BĐS', 'desc' => '' ],
		'dm_loai_anh'       => [ 'name' => 'Loại ảnh', 'desc' => '' ],
		'dm_loai_bds'       => [ 'name' => 'Loại BĐS', 'desc' => '' ],
		'dm_phap_ly'        => [ 'name' => 'Pháp lý', 'desc' => '' ],
		'dm_phap_ly_dat'    => [ 'name' => 'Pháp lý Đất', 'desc' => '' ],
		'dm_phap_ly_nha'    => [ 'name' => 'Pháp lý Nhà', 'desc' => '' ],
		'dm_vlxd'           => [ 'name' => 'VLXD', 'desc' => '' ],
		'dm_huong'          => [ 'name' => 'Hướng', 'desc' => '' ],
	];
	
	
	/**
	 * Validate category name
	 *
	 * @param $type
	 * @return bool
	 */
	private function isValid($type)
	{
		return isset($this->category_list[$type]);
	}
	
	
	/**
	 * Get model instance of a category
	 *
	 * @param $type
	 * @return mixed
	 */
	private function getInstance($type)
	{
		$className = '\App\Models\\' . studly_case($type);
		
		return new $className();
	}
	
	
	/**
	 * @param $type
	 * @param $id
	 * @return mixed
	 */
	private function getRecord($type, $id)
	{
		$obj = $this->getInstance($type);
		
		if (!empty($id) && is_numeric($id)) {
			$obj = $obj::find($id);
			
			if (!$obj) {
				abort(404, 'Danh mục ' . $this->category_list[$type]['name'] . 'không tồn tại [ID:' . $id . ']');
			}
		}
		
		return $obj;
	}
	
	
	/**
	 * @param $type
	 * @return array
	 */
	private function getParents($type)
	{
		$list = [];
		
		/* If parents list of District, then sort by Province ASC */
		if ($type == 'dm_hc_huyen') {
			return $this->getInstance('dm_hc_tinh')->orderBy('giatri')->get();
		}
		/* If parents list of Ward, then sort by Province, District ASC */
		elseif ($type == 'dm_hc_xa') {
			return $this->getInstance('dm_hc_huyen')
				->select('dm_hc_huyen.*')
				->leftJoin('dm_hc_tinh', 'dm_hc_huyen.dm_hc_tinh', 'dm_hc_tinh.id')
				->orderBy('dm_hc_tinh.giatri', 'ASC')
				->orderBy('dm_hc_huyen.giatri', 'ASC')
				->get();
		}
		
		return $list;
	}
	
	
	/**
	 * @param Request $request
	 * @param $type
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(Request $request, $type)
    {
    	/* Validate Category type */
    	if (!$this->isValid($type)) {
    		abort(404);
	    }
    
        if (!$request->ajax()) {
            Permission::has('C_LIST', true);
        }
	    
	    /* If Districts list, then sort by Province, District ASC */
	    if ($type == 'dm_hc_huyen') {
	    	$list = $this->getInstance($type)
			    ->select('dm_hc_huyen.*')
			    ->leftJoin('dm_hc_tinh', 'dm_hc_huyen.dm_hc_tinh', 'dm_hc_tinh.id')
			    ->orderBy('dm_hc_tinh.giatri', 'ASC')
		        ->orderBy('dm_hc_huyen.giatri', 'ASC');
	    	
	    	$parent = $request->get('parent');
	    	
	    	if ($parent) {
	    	    $list = $list->where('dm_hc_tinh.id', '=', $parent);
            } elseif ($request->ajax()) {
                $list = $list->where('dm_hc_tinh.id', '=', -1);
            }
	    }
	    /* If Wards list, then sort by Province, District, Ward */
	    elseif ($type == 'dm_hc_xa') {
		    $list = $this->getInstance($type)
			    ->select('dm_hc_xa.*')
			    ->leftJoin('dm_hc_huyen', 'dm_hc_xa.dm_hc_huyen', 'dm_hc_huyen.id')
			    ->leftJoin('dm_hc_tinh', 'dm_hc_huyen.dm_hc_tinh', 'dm_hc_tinh.id')
			    ->orderBy('dm_hc_tinh.giatri', 'ASC')
			    ->orderBy('dm_hc_huyen.giatri', 'ASC')
			    ->orderBy('dm_hc_xa.giatri', 'ASC');
        
            $parent = $request->get('parent');
        
            if ($parent) {
                $list = $list->where('dm_hc_huyen.id', '=', $parent);
            } elseif ($request->ajax()) {
                $list = $list->where('dm_hc_huyen.id', '=', -1);
            }
	    }
	    /* Otherwise, sort by itself name */
	    else {
		    $list = $this->getInstance($type)
			    ->orderBy('giatri');
	    }
	    
	    /* If request is JSON, then return JSON object */
	    if ($request->ajax()) {
	    	$selectFields[] = $type . '.id';
	
	        if ($type == 'dm_hc_xa') {
	        	$selectFields[] = 'dm_hc_tinh.giatri as text2';
	        	$selectFields[] = 'dm_hc_huyen.giatri as text1';
	        	$selectFields[] = 'dm_hc_xa.giatri as text';
	        }
	         elseif ($type == 'dm_hc_huyen') {
		         $selectFields[] = 'dm_hc_tinh.giatri as text1';
		         $selectFields[] = 'dm_hc_huyen.giatri as text';
	        }
	        else {
		        $selectFields[] = $type . '.giatri as text';
	        }
	    	
		    return response()->json($list->select($selectFields)->get());
	    }
	    /* Otherwise, Render view in HTML */
	    else {
		    return view('admin.category.index', [
			    'category_type' => $type,
			    'category_name' => $this->category_list[$type]['name'],
			    'category_description' => $this->category_list[$type]['desc'],
			    'categories' => $list->paginate(20),
		    ]);
	    }
    }
	
	
	/**
	 * Show Add form
	 *
	 * @param $type
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function formAdd($type)
    {
        Permission::has('C_ADD', true);
        
    	/* Render form with a fresh-new model object */
    	return view('admin.category.form', [
    		'category_title' => 'Tạo mới',
		    'category_type' => $type,
		    'category_name' => $this->category_list[$type]['name'],
		    'category_description' => $this->category_list[$type]['desc'],
		    'category' => $this->getInstance($type),
		    'parents' => $this->getParents($type),
		    'parent_current' => -1,
	    ]);
    }
	
	
	/**
	 * Show Edit form
	 *
	 * @param $type
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function formEdit($type, $id)
    {
        Permission::has('C_EDIT', true);
        
	    $parent_current = -1;
	    $obj = $this->getRecord($type, $id, true);
	    
	    if ($type == 'dm_hc_huyen') {
	    	$parent_current = $obj->dm_hc_tinh()->first()->id;
	    }
	    elseif ($type == 'dm_hc_xa') {
		    $parent_current = $obj->dm_hc_huyen()->first()->id;
	    }
	
	    /* Render form with existed data */
	    return view('admin.category.form', [
		    'category_title' => 'Chỉnh sửa',
		    'category_type' => $type,
		    'category_name' => $this->category_list[$type]['name'],
		    'category_description' => $this->category_list[$type]['desc'],
		    'category' => $obj,
		    'parents' => $this->getParents($type),
		    'parent_current' => $parent_current,
	    ]);
    }
	
	
	/**
	 * @param Request $request
	 * @param $type
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function save(Request $request, $type)
    {
    	$id = $request->id;
    	
    	if (empty($id)) {
            Permission::has('C_ADD', true);
        }
        else {
            Permission::has('C_EDIT', true);
        }
    	
	    $obj = $this->getRecord($type, $id);
	
	    if ($type == 'dm_hc_huyen') {
		    $obj->dm_hc_tinh = $request->parent;
	    }
	    elseif ($type == 'dm_hc_xa') {
		    $obj->dm_hc_huyen = $request->parent;
	    }
	    
	    $obj->giatri = $request->giatri;
    	$obj->diengiai = $request->diengiai;
    	$obj->trangthai = $request->trangthai;
    	
	    $obj->save();
	    Session::flash('flash-success', 'Đã lưu thành công danh mục: ' . $request->giatri);
    	
    	return redirect()->route('admin.category', [ 'type' => $type ]);
    }
	
	
	/**
	 * Active a Category
	 *
	 * @param Request $request
	 * @param $type
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function active(Request $request, $type, $id)
    {
        Permission::has('C_EDIT', true);
        
    	$obj = $this->getRecord($type, $id);
    	$obj->trangthai = 1;
    	$obj->save();
	
	    Session::flash('flash-success', 'Đã Bật Danh mục: ' . $obj->giatri);
	    return redirect()->route('admin.category', [ 'type' => $type ]);
    }
	
	
	/**
	 * Deactive a Category
	 *
	 * @param Request $request
	 * @param $type
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function deactive(Request $request, $type, $id)
    {
        Permission::has('C_EDIT', true);
        
    	$obj = $this->getRecord($type, $id);
    	$obj->trangthai = 0;
    	$obj->save();
	
	    Session::flash('flash-success', 'Đã Ngưng sử dụng Danh mục: ' . $obj->giatri);
	    return redirect()->route('admin.category', [ 'type' => $type ]);
    }
	
	
	/**
	 * Delete a Category
	 *
	 * @param Request $request
	 * @param $type
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete(Request $request, $type, $id)
	{
        Permission::has('C_DELETE', true);
        
		$err = null;
		$obj = $this->getRecord($type, $id);
		
		try {
			$obj->delete();
		}
		catch (QueryException $ex) {
			$err = true;
			Session::flash('flash-error', 'Đang có dữ liệu tham chiếu đến danh mục ' . $obj->giatri
				. '. Vui lòng xoá dữ liệu có liên quan trước!');
		}
		
		if ($err === null) {
			Session::flash('flash-success', 'Đã Xoá Danh mục: ' . $obj->giatri);
		}
		
		return redirect()->route('admin.category', [ 'type' => $type ]);
	}
}
