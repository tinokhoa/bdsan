<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\UsersFormRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGroup;
use App\Helpers\Permission;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        Permission::has('U_LIST', true);
        
        return view('admin.users.index', [
            'users' => User::where('id', '<>', 1)
                ->where('id', '<>', Auth::guard('admin')->user()->id)
                ->paginate(20)
        ]);
    }
    
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formAdd()
    {
        Permission::has('U_ADD', true);
        
        /* Render form with a fresh-new model object */
        return view('admin.users.form', [
            'form_title' => 'Tạo mới',
            'user' => new User(),
        ]);
    }
    
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formEdit($id)
    {
        Permission::has('U_EDIT', true);
        
        /* Render form with a fresh-new model object */
        return view('admin.users.form', [
            'form_title' => 'Cập nhật',
            'user' => User::find($id),
        ]);
    }
    
    
    /**
     * @param UsersFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(UsersFormRequest $request)
    {
        $id = $request->id;
        $obj = new User();
        
        if (!empty($id)) {
            Permission::has('C_EDIT', true);
            $obj = User::find($id);
        }
        else {
            Permission::has('C_ADD', true);
        }
        
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->user_group = $request->user_group;
        
        if ($request->password != $obj->password) {
            $obj->password = Hash::make($request->password);
        }
        
        $obj->save();
        Session::flash('flash-success', 'Đã lưu thành công người dùng ' . $request->name);
        
        return redirect()->route('admin.users');
    }
    
    
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function groups()
    {
        $groups = new UserGroup();
        
        return response()->json(
            $groups->select(['user_groups.id', 'user_groups.name as text'])
                ->orderBy('id', 'ASC')
                ->get()
        );
    }
}
