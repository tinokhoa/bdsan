@extends('layouts.admin')

@section('page_title') Bất động sản @endsection

@section('content')

    {{-- Content Header (Page header) --}}
    <section class="content-header">
        <h1>
            Bất động sản
            @if ($sp->id) #{!! $sp->id !!}{{---{!! $sp_hoso->id !!}--}} @endif
            <small>Cập nhật thông tin bất động sản</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
            <li><a href="{!! route('admin.re') !!}">Bất động sản</a></li>
        </ol>
    </section>
    {{-- /.content-header --}}

    {{-- Main content --}}
    <section class="content">

        <form id="formMain" role="form" method="post" action="{!! route('admin.re.save') !!}" onsubmit="unmask()">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    @if ($sp->id)
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                Chọn hồ sơ ({!! $sp->SpHoSo()->count() !!}) <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                @if (\Permission::has('R_PROFILE_ADD'))
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1"
                                           href="{!! route('admin.re.add.hoso', ['id_sp' => $sp->id]) !!}">
                                            <span class="text-success">
                                                <i class="fa fa-plus-circle"></i>
                                                Tạo hồ sơ mới
                                            </span>
                                        </a>
                                    </li>
                                @endif
                                @if (\Permission::has('R_PROFILE_DELETE'))
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" class="confirmation"
                                           data-confirm="Bạn có chắc chắn muốn xoá hồ sơ này không?"
                                           href="{!! route('admin.re.delete.hoso', ['id_sp' => $sp_hoso->id]) !!}">
                                            <span class="text-danger">
                                                <i class="fa fa-trash"></i>
                                                Xoá hồ sơ hiện tại
                                            </span>
                                        </a>
                                    </li>
                                @endif
                                <li role="presentation" class="divider"></li>
                                @foreach ($sp->SpHoSo()->get() as $item)
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1"
                                           href="{!! route('admin.re.edit', ['id' => $item->id]) !!}">
                                            Hồ sơ #{!! $item->id !!} - {!! $item->created_at !!}
                                            @if ($sp_hoso->id == $item->id)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    <li class="active"><a href="#tab_hoso" data-toggle="tab">Hồ sơ #{!! $sp_hoso->id !!}</a></li>
                    <li><a href="#tab_phaply" data-toggle="tab">Pháp lý</a></li>
                    <li><a href="#tab_tep" data-toggle="tab">Files đính kèm</a></li>
                    <li><a href="#tab_vitri" data-toggle="tab">Vị trí</a></li>
                    <li><a href="#tab_nha" data-toggle="tab">Nhà</a></li>
                    <li><a href="#tab_dat" data-toggle="tab">Đất</a></li>
                    <li><a href="#tab_danhgia" data-toggle="tab">Đánh giá</a></li>
                    <li><a href="#tab_thongtin" data-toggle="tab">Thông tin</a></li>
                    <li><a href="#tab_ketluan" data-toggle="tab">Kết luận</a></li>
                    <li><a href="#tab_ghichu" data-toggle="tab">Ghi chú</a></li>

                    @if (\Permission::has('R_ADD') || \Permission::has('R_EDIT'))
                        <li class="pull-right">
                            <button type="submit" class="text-success">
                                <i class="fa fa-save"></i> Lưu
                            </button>
                        </li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_hoso">@include('admin.bds.form_hoso')</div>
                    <div class="tab-pane" id="tab_phaply">@include('admin.bds.form_phaply')</div>
                    <div class="tab-pane" id="tab_tep">@include('admin.bds.form_tep')</div>
                    <div class="tab-pane" id="tab_vitri">@include('admin.bds.form_vitri')</div>
                    <div class="tab-pane" id="tab_nha">@include('admin.bds.form_nha')</div>
                    <div class="tab-pane" id="tab_dat">@include('admin.bds.form_dat')</div>
                    <div class="tab-pane" id="tab_danhgia">@include('admin.bds.form_danhgia')</div>
                    <div class="tab-pane" id="tab_thongtin">@include('admin.bds.form_thongtin')</div>
                    <div class="tab-pane" id="tab_ketluan">@include('admin.bds.form_ketluan')</div>
                    <div class="tab-pane" id="tab_ghichu">@include('admin.bds.form_ghichu')</div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->

            <input type="hidden" name="id" value="{!! old('id', $sp->id) !!}" />
            <input type="hidden" name="id_hoso" value="{!! old('id_hoso', $sp_hoso->id) !!}" />
            {!! csrf_field() !!}

        </form>

        @if ($sp_hoso->id)
            <form id="formMainImages" method="post" enctype="multipart/form-data" class="hidden"
                  action="{!! route('admin.re.upload.file', ['id' => $sp_hoso->id]) !!}?type=img">
                <input type="file" id="img-selector" name="files[]" accept="image/*" multiple>
            </form>
            <form id="formMainFiles" method="post" enctype="multipart/form-data" class="hidden"
                  action="{!! route('admin.re.upload.file', ['id' => $sp_hoso->id]) !!}?type=file">
                <input type="file" id="file-selector" name="files[]" multiple>
            </form>
        @endif

    </section>
    {{-- /.content --}}

    <script>
        window.addEventListener("load", function() {
            $('textarea').wysihtml5();

            @if ($sp->id)
                var formAction = $('#formMain').attr('action');

                $('.nav-tabs a').on('shown.bs.tab', function (e) {
                    $('#formMain').attr('action', formAction + '?return=' + location.href);
                });
            @endif
        });
    </script>

@endsection