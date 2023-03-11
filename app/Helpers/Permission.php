<?php

namespace App\Helpers;

use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;

class Permission
{
    private static $currentPermissions = null;
    
    /**
     *
     */
    public static function throwError($permission)
    {
        $permissionsList = (new UserGroup)->getPermissions();
        $permissions = [];
        
        foreach ($permissionsList as $a) {
            $permissions = array_merge($permissions, $a);
        }
        
        if (isset($permissions[$permission])) {
            $permission = $permissions[$permission];
        }
        
        abort(403, 'Bạn không có quyền [' . $permission . '] để thực hiện thao tác này');
    }
    
    
    /**
     * @return null
     */
    private static function getGroup()
    {
        $currentUser = Auth::guard('admin')->user();
        
        if ($currentUser->user_group != null) {
            return $currentUser->UserGroup()->first();
        }
        else {
            return null;
        }
    }
    
    
    /**
     * @param $permission
     * @param bool $throwError
     * @return bool
     */
    public static function has($permission, $throwError = false)
    {
        if (Auth::guard('admin')->user()->id == 1) {
            return true;
        }
        
        $result = false;
    
        if (self::$currentPermissions === null) {
            $group = self::getGroup();
    
            if ($group) {
                self::$currentPermissions = $group->permissions;
            }
            else {
                self::$currentPermissions = '';
            }
        }
    
        $p = ',' . self::$currentPermissions . ',';
        $result = (strpos($p, ',' . $permission . ',') !== false);
    
        if ($throwError) {
            if (!$result) {
                self::throwError($permission);
            }
            else {
                return true;
            }
        }
        else {
            return $result;
        }
    }
}