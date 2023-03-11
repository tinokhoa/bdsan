@extends('layouts.admin')

@section('page_title') Người dùng @endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Người dùng
            <small>Quản lý các người dùng trong hệ thống</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
            <li><a href="#">Người dùng</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Danh sách</h3>
                <div class="pull-right">
                    @if (Permission::has('U_ADD', true))
                        {{-- Add button --}}
                        <a href="{!! route('admin.users.add') !!}" class="btn btn-success">
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
                        <th>Email</th>
                        <th>Nhóm</th>
                        <th width="15%">Trạng thái</th>
                        <th width="15%">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($users as $user)
                        <tr>
                            {{-- id --}}
                            <td>{!! $user->id !!}</td>

                            {{-- name --}}
                            <td>
                                <a href="{!! route('admin.users.edit', ['id' => $user->id]) !!}">
                                    {!! $user->name !!}
                                </a>
                            </td>

                            {{-- email --}}
                            <td>{!! $user->email !!}</td>

                            {{-- user_group --}}
                            <td>
                                @if ($user->user_group)
                                    {!! $user->UserGroup()->first()->name !!}
                                @endif
                            </td>

                            {{-- trangthai --}}
                            <td>
                                {{--@if ($category->trangthai == 0)
                                    <a href="{!! route('admin.category.active', [ 'type' => $category_type, 'id' => $category->id ]) !!}"
                                       class="label label-sm label-danger"
                                       title="Bấm để Sử dụng lại">Ngưng sử dụng</a>
                                @else
                                    <a href="{!! route('admin.category.deactive', [ 'type' => $category_type, 'id' => $category->id ]) !!}"
                                       class="label label-sm label-primary"
                                       title="Bấm để Ngưng sử dụng">Sử dụng</a>
                                @endif--}}
                            </td>

                            {{-- Thao tác --}}
                            <td>
                                {{--<a href="{!! route('admin.category.delete', [ 'type' => $category_type, 'id' => $category->id ]) !!}"
                                   class="label label-sm label-danger"
                                   title="Bấm để Xoá danh mục">Xoá</a>--}}
                            </td>
                        </tr>
                    @endforeach

                    @if (count($users) == 0)
                        <tr>
                            <td colspan="5" class="text-center">
                                <em>
                                    Bạn chưa có bất kỳ Người dùng nào!
                                    Vui lòng <a href="{!! route('admin.users.add') !!}">tạo mới</a>
                                </em>
                            </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                {!! $users->links() !!}
            </div>
            <!-- /.box-footer-->

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection