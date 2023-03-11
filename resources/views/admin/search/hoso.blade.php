@extends('layouts.admin')

@section('page_title') Tìm kiếm hồ sơ @endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tìm kiếm hồ sơ
            {{--<small>Quản lý thông tin các Bất động sản</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
            <li><a href="{!! route('admin.search.hoso') !!}">TÌm kiếm hồ sơ</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @include('admin.search.hoso_filter')

        <!-- Default box -->
        <div class="box">

            <div class="box-header with-border">
                <em>Tìm thấy {!! $hoso->count() !!} hồ sơ</em>
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
                        {{--<th width="15%">Thao tác</th>--}}
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($hoso as $hs)
                        @php( $item = $hs->Sp()->first() )
                        <tr>
                            {{-- id --}}
                            <td>HS-{!! $hs->id !!}</td>

                            {{-- ten --}}
                            <td>
                                <a href="{!! route('admin.re.edit', ['id' => $hs->id]) !!}">
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
                            {{--<td>
                                <a href=""
                                   class="label label-sm label-danger"
                                   title="Bấm để Xoá sản phẩm">Xoá</a>
                            </td>--}}
                        </tr>
                    @endforeach

                    @if (count($hoso) == 0)
                        <tr>
                            <td colspan="5" class="text-center">
                                <em>
                                    Không tìm thấy bất kỳ sản phẩm nào!
                                </em>
                            </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                {!! $hoso->links() !!}
            </div>
            <!-- /.box-footer-->

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection