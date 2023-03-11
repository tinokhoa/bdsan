<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    private $permissions = [
        'Danh mục' => [
            'C_LIST' => 'Quản lý danh mục', //
            'C_ADD' => 'Tạo danh mục',
            'C_EDIT' => 'Chỉnh sửa danh mục',
            'C_DELETE' => 'Xoá danh mục',
        ],
        'Bất động sản' => [
            'R_LIST' => 'Quản lý BĐS', //
            'R_ADD' => 'Tạo sản phẩm', //
            'R_EDIT' => 'Chỉnh sửa sản phẩm', //
            'R_DELETE' => 'Xoá sản phẩm',
            'R_PROFILE_ADD' => 'Tạo hồ sơ', //
            'R_PROFILE_DELETE' => 'Xoá hồ sơ',
            'R_PROFILE_VIEW' => 'Xem hồ sơ',
        ],
        'Người dùng' => [
            'U_LIST' => 'Quản lý người dùng', //
            'U_ADD' => 'Tạo người dùng', //
            'U_EDIT' => 'Chỉnh sửa người dùng', //
            'U_DELETE' => 'Xoá người dùng', //
        ],
    ];
    
    
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'user_groups';
	
	
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
    
    
    /**
     * Get childs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Users()
    {
        return $this->hasMany('App\Models\User', 'user_group', 'id');
    }
    
    
    /**
     * @return array
     */
    public function getPermissions()
    {
        return $this->permissions;
    }
}
