@extends('layouts.admin')

@section('page_title') Người dùng @endsection

@section('content')

    {{-- Content Header (Page header) --}}
    <section class="content-header">
        <h1>
            Người dùng
            <small>Quản lý các người dùng trong hệ thống</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
            <li><a href="{!! route('admin.users') !!}">Người dùng</a></li>
        </ol>
    </section>
    {{-- /.content-header --}}

    {{-- Main content --}}
    <section class="content">

        <div clas="row">
            <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-3 col-sm-offset-2">

                <form role="form" method="post" action="{!! route('admin.users.save') !!}">

                    {{-- Default box --}}
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                {!! $form_title !!} Người dùng
                            </h3>

                            <div class="pull-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Lưu
                                </button>
                            </div>
                        </div>
                        {{-- /.box-header --}}

                        <div class="box-body">

                            <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                <label for="name">Họ tên</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên người dùng"
                                    value="{!! old('name', $user->name) !!}" maxlength="255" autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">{!! $errors->first('name') !!}</span>
                                @endif
                            </div>
                            {{-- /.name --}}

                            <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                       value="{!! old('email', $user->email) !!}" maxlength="255">
                                @if ($errors->has('email'))
                                    <span class="help-block">{!! $errors->first('email') !!}</span>
                                @endif
                            </div>
                            {{-- /.email --}}

                            <div class="form-group">
                                <label for="user_group">Nhóm người dùng</label>
                                <select name="user_group" id="user_group" class="form-control select2"
                                        data-source="{!! route('admin.users.groups') !!}">
                                    <option value="{!! old('user_group', $user->user_group) !!}"></option>
                                </select>
                            </div>
                            {{-- /.user_group --}}

                            <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                                <label for="password">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu"
                                       value="{!! old('password', $user->password) !!}" maxlength="100">
                                @if ($errors->has('password'))
                                    <span class="help-block">{!! $errors->first('password') !!}</span>
                                @endif
                            </div>
                            {{-- /.password --}}

                            <div class="form-group">
                                <label for="password_confirmation">Nhập lại Mật khẩu</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại Mật khẩu"
                                       value="{!! old('password_confirmation', $user->password) !!}" maxlength="100">
                            </div>
                            {{-- /.re_password --}}

                            <?php
                                /*$trangthai = old('trangthai', $category->trangthai);

                                if ($trangthai == 1 || $trangthai === null):
	                                $trangthai1 = 'checked';
	                                $trangthai0 = '';
                                else:
	                                $trangthai1 = '';
	                                $trangthai0 = 'checked';
                                endif;*/
                            ?>

                            {{--<div class="form-group">
                                <label>Trạng thái</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="trangthai" id="trangthai1" value="1" {!! $trangthai1 !!}>
                                        Sử dụng
                                    </label>
                                    <label>
                                        <input type="radio" name="trangthai" id="trangthai0" value="0" {!! $trangthai0 !!}>
                                        Ngưng sử dụng
                                    </label>
                                </div>
                            </div>--}}
                            {{-- /.trangthai --}}

                        </div>
                        {{-- /.box-body --}}

                    </div>
                    {{-- /.box --}}

                    <input type="hidden" name="id" value="{!! old('id', $user->id) !!}" />
                    {!! csrf_field() !!}

                </form>

            </div>
            {{-- /.col-* --}}
        </div>
        {{-- /.row --}}

    </section>
    {{-- /.content --}}

@endsection