<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{!! url('dist/img/user2-160x160.jpg') !!}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{!! \Auth::guard('admin')->user()->name !!}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    {{--<!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>
    <!-- /.search form -->--}}
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="{!! route('admin.dashboard') !!}">
                <i class="fa fa-dashboard"></i> <span>Bảng điều khiển</span>
            </a>
        </li>

        <li><a href="{!! route('admin.search.hoso') !!}"><i class="fa fa-search"></i> <span>Tìm hồ sơ</span></a></li>
        <li><a href="{!! route('admin.search.quanhday') !!}"><i class="fa fa-map-marker"></i> <span>Tìm quanh đây</span></a></li>

        @if (\Permission::has('C_LIST'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Danh mục</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! route('admin.category', ['type' => 'dm_hc_tinh']) !!}"><i class="fa fa-circle-o"></i> Tỉnh / Thành phố</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_hc_huyen']) !!}"><i class="fa fa-circle-o"></i> Quận / Huyện</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_hc_xa']) !!}"><i class="fa fa-circle-o"></i> Xã / Phường</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_hc_duong']) !!}"><i class="fa fa-circle-o"></i> Đường</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_loai_bds']) !!}"><i class="fa fa-circle-o"></i> Loại BĐS</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_kieu_bds']) !!}"><i class="fa fa-circle-o"></i> Kiểu BĐS</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_phap_ly']) !!}"><i class="fa fa-circle-o"></i> Pháp lý</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_phap_ly_dat']) !!}"><i class="fa fa-circle-o"></i> Pháp lý Đất</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_phap_ly_nha']) !!}"><i class="fa fa-circle-o"></i> Pháp lý Nhà</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_loai_anh']) !!}"><i class="fa fa-circle-o"></i> Loại ảnh</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_vlxd']) !!}"><i class="fa fa-circle-o"></i> VLXD</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_ket_cau']) !!}"><i class="fa fa-circle-o"></i> Kết cấu</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_ha_tang']) !!}"><i class="fa fa-circle-o"></i> Hạ tầng kỹ thuật</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_don_vi']) !!}"><i class="fa fa-circle-o"></i> Đơn vị</a></li>
                    <li><a href="{!! route('admin.category', ['type' => 'dm_huong']) !!}"><i class="fa fa-circle-o"></i> Hướng</a></li>
                </ul>
            </li>
        @endif

        @if (\Permission::has('R_LIST') || \Permission::has('R_ADD'))
        <li class="treeview">
            <a href="#">
                <i class="fa fa-folder"></i> <span>Bất động sản</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
                @if (\Permission::has('R_LIST'))
                    <li><a href="{!! route('admin.re') !!}"><i class="fa fa-list"></i> Quản lý</a></li>
                @endif
                @if (\Permission::has('R_ADD'))
                    <li><a href="{!! route('admin.re.add') !!}"><i class="fa fa-plus"></i> Tạo mới</a></li>
                @endif
            </ul>
        </li>
        @endif

        @if (\Permission::has('U_LIST'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Người dùng</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! route('admin.users') !!}"><i class="fa fa-list"></i> Quản lý</a></li>
                    {{--<li><a href="{!! route('admin.re.add') !!}"><i class="fa fa-plus"></i> Tạo mới</a></li>
                    <li><a href="{!! route('admin.search.hoso') !!}"><i class="fa fa-search"></i> Tìm hồ sơ</a></li>
                    <li><a href="{!! route('admin.search.quanhday') !!}"><i class="fa fa-map-marker"></i> Tìm quanh đây</a></li>--}}
                </ul>
            </li>
        @endif
    </ul>
</section>
<!-- /.sidebar -->