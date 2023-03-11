@extends('layouts.admin')

@section('page_title') Danh mục {!! $category_name !!} @endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh mục {!! $category_name !!}
            <small>{!! $category_description !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
            <li><a href="#">Danh mục {!! $category_name !!}</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Danh sách</h3>
                <div class="pull-right">
                    @if (\Permission::has('C_ADD'))
                        {{-- Add button --}}
                        <a href="{!! route('admin.category.add', [ 'type' => $category_type ]) !!}" class="btn btn-success">
                            <i class="fa fa-plus"></i> Tạo mới
                        </a>
                    @endif
                </div>
            </div>

            <div class="box-body">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Tên</th>
                            <th>Diễn giải</th>
                            <th width="15%">Trạng thái</th>
                            <th width="15%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($categories as $category)
                        <tr>
                            {{-- id --}}
                            <td>{!! $category->id !!}</td>

                            {{-- giatri --}}
                            <td>
                                @if ($category_type == 'dm_hc_huyen')
                                    {!! $category->DmHcTinh()->first()->giatri !!} /
                                @endif

                                @if ($category_type == 'dm_hc_xa')
                                    {!! $category->DmHcHuyen()->first()->DmHcTinh()->first()->giatri !!} /
                                    {!! $category->DmHcHuyen()->first()->giatri !!} /
                                @endif

                                <a href="{!! route('admin.category.edit', [ 'type' => $category_type, 'id' => $category->id ]) !!}">
                                    {!! $category->giatri !!}
                                </a>
                            </td>

                            {{-- diengiai --}}
                            <td>{!! $category->diengiai !!}</td>

                            {{-- trangthai --}}
                            <td>
                                @if ($category->trangthai == 0)
                                    @if (\Permission::has('C_EDIT'))
                                        <a href="{!! route('admin.category.active', [ 'type' => $category_type, 'id' => $category->id ]) !!}"
                                           class="label label-sm label-danger"
                                           title="Bấm để Sử dụng lại">Ngưng sử dụng</a>
                                    @else
                                        Ngưng sử dụng
                                    @endif
                                @else
                                    @if (\Permission::has('C_EDIT'))
                                    <a href="{!! route('admin.category.deactive', [ 'type' => $category_type, 'id' => $category->id ]) !!}"
                                       class="label label-sm label-primary"
                                       title="Bấm để Ngưng sử dụng">Sử dụng</a>
                                    @else
                                        Sử dụng
                                    @endif
                                @endif
                            </td>

                            {{-- Thao tác --}}
                            <td>
                                @if (\Permission::has('C_DELETE'))
                                    <a href="{!! route('admin.category.delete', [ 'type' => $category_type, 'id' => $category->id ]) !!}"
                                       class="label label-sm label-danger confirmation" data-confirm="Bạn có chắc chắn muốn xoá danh mục này không?"
                                       title="Bấm để Xoá danh mục">Xoá</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    @if (count($categories) == 0)
                        <tr>
                            <td colspan="5" class="text-center">
                                <em>
                                    Bạn chưa có bất kỳ Danh mục {!! $category_name !!} nào!
                                    Vui lòng <a href="{!! route('admin.category.add', [ 'type' => $category_type ]) !!}">tạo mới</a>
                                </em>
                            </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                {!! $categories->links() !!}
            </div>
            <!-- /.box-footer-->

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection