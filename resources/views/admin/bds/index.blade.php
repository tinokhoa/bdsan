@extends('layouts.admin')

@section('page_title') Danh sách sản phẩm @endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách sản phẩm
            <small>Quản lý thông tin các Bất động sản</small>
            @if (Permission::has('R_ADD', true))
                <a href="{!! route('admin.re.add') !!}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus"></i> Tạo mới
                </a>
            @endif
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
            <li><a href="#">Danh sách sản phẩm</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @include('admin.bds.index_filter')

        <!-- Default box -->
        <div class="box">

            <div class="box-header with-border">
                {{--<h3 class="box-title">Danh sách</h3>
                <div class="pull-right">
                     Add button
                </div>--}}
                <em>Tìm thấy {!! $sp->count() !!} sản phẩm</em>
            </div>

            <div class="box-body">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Tên</th>
                            <th width="15%" class="text-right">Giá trị</th>
                            <th width="15%" class="text-center">Loại</th>
                            <th width="15%" class="text-center">Kiểu</th>
                            <th width="15%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($sp as $item)
                        <tr>
                            {{-- id --}}
                            <td>SP-{!! $item->id !!}</td>

                            {{-- ten --}}
                            <td>
                                <a href="{!! route('admin.re.edit', ['id' => $item->SpHoSo()->orderBy('id', 'DESC')->first()->id]) !!}">
                                    {!! $item->ten !!}
                                </a>
                                <div>
                                    <small>
                                        {!! $item->diachi !!},
                                        <?php
                                            $dm_xa = $item->DmHcXa()->first();
                                            $dm_huyen = $dm_xa->DmHcHuyen()->first();
                                            $dm_tinh = $dm_huyen->DmHcTinh()->first();
                                        ?>
                                        {!! $dm_xa->giatri !!} /
                                        {!! $dm_huyen->giatri !!} /
                                        {!! $dm_tinh->giatri !!}
                                    </small>
                                </div>
                            </td>

                            {{-- giatri --}}
                            <td class="text-right">{!! number_format($item->giatri) !!}</td>

                            {{-- loai --}}
                            <td class="text-center">{!! $item->DmLoaiBds()->first()->giatri !!}</td>

                            {{-- kieu --}}
                            <td class="text-center">{!! $item->DmKieuBds()->first()->giatri !!}</td>

                            {{-- Thao tác --}}
                            <td>
                                @if (\Permission::has('R_DELETE'))
                                    <a href="{!! route('admin.re.delete', ['id_sp' => $item->id]) !!}"
                                       class="label label-sm label-danger confirmation"
                                       data-confirm="Bạn có chắc chắn muốn xoá sản phẩm này không?"
                                       title="Bấm để Xoá sản phẩm">Xoá</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    @if (count($sp) == 0)
                        <tr>
                            <td colspan="6" class="text-center">
                                <em>
                                    Không tìm thấy bất kỳ Sản phẩm nào!
                                    Bạn có thể bấm <a href="{!! route('admin.re.add') !!}">vào đây</a> để tạo mới
                                </em>
                            </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                {!! $sp->links() !!}
            </div>
            <!-- /.box-footer-->

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection