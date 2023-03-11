@extends('layouts.admin')

@section('page_title') Danh mục {!! $category_name !!} @endsection

@section('content')

    {{-- Content Header (Page header) --}}
    <section class="content-header">
        <h1>
            Danh mục {!! $category_name !!}
            <small>{!! $category_description !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
            <li><a href="{!! route('admin.category', [ 'type' => $category_type ]) !!}">Danh mục {!! $category_name !!}</a></li>
        </ol>
    </section>
    {{-- /.content-header --}}

    {{-- Main content --}}
    <section class="content">

        <div clas="row">
            <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-3 col-sm-offset-2">

                <form role="form" method="post" action="{!! route('admin.category.save', [ 'type' => $category_type ]) !!}">

                    {{-- Default box --}}
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                {!! $category_title !!}
                            </h3>

                            <div class="pull-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Lưu
                                </button>
                            </div>
                        </div>
                        {{-- /.box-header --}}

                        <div class="box-body">

                            @if (in_array($category_type, ['dm_hc_huyen', 'dm_hc_xa']))
                                <div class="form-group">
                                    <label for="parent">Danh mục cha</label>
                                    <select class="form-control select2" name="parent" autofocus>

                                        <?php $parent_selected = old('parent', $parent_current); ?>

                                        @foreach ($parents as $parent)
                                            <option value="{!! $parent->id !!}" {!! ($parent_selected == $parent->id) ? 'selected' : '' !!}>
                                                @if ($category_type == 'dm_hc_xa')
                                                    {!! $parent->DmHcTinh()->first()->giatri !!} /
                                                @endif

                                                {!! $parent->giatri !!}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                {{-- /.giatri --}}
                            @endif

                            <div class="form-group">
                                <label for="giatri">Tên danh mục</label>
                                <input type="text" class="form-control" id="giatri" name="giatri" placeholder="Tên danh mục"
                                    value="{!! old('giatri', $category->giatri) !!}" maxlength="100" autofocus>
                            </div>
                            {{-- /.giatri --}}

                            <div class="form-group">
                                <label for="diengiai">Diễn giải</label>
                                <input type="text" class="form-control" id="diengiai" name="diengiai" placeholder="Diễn giải"
                                       value="{!! old('diengiai', $category->diengiai) !!}" maxlength="200">
                            </div>
                            {{-- /.diengiai --}}

                            <?php
                                $trangthai = old('trangthai', $category->trangthai);

                                if ($trangthai == 1 || $trangthai === null):
	                                $trangthai1 = 'checked';
	                                $trangthai0 = '';
                                else:
	                                $trangthai1 = '';
	                                $trangthai0 = 'checked';
                                endif;
                            ?>

                            <div class="form-group">
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
                            </div>
                            {{-- /.trangthai --}}

                        </div>
                        {{-- /.box-body --}}

                    </div>
                    {{-- /.box --}}

                    <input type="hidden" name="id" value="{!! old('id', $category->id) !!}" />
                    {!! csrf_field() !!}

                </form>

            </div>
            {{-- /.col-* --}}
        </div>
        {{-- /.row --}}

    </section>
    {{-- /.content --}}

@endsection