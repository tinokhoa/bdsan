@extends('layouts.admin')

@section('page_title') Tìm quanh đây @endsection

@section('content')

    <!-- Content Header (Page header) -->
    {{--<section class="content-header">
        <h1>
            Tìm quanh đây
            --}}{{--<small>Quản lý thông tin các Bất động sản</small>--}}{{--
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
            <li><a href="{!! route('admin.search.hoso') !!}">TÌm kiếm hồ sơ</a></li>
        </ol>
    </section>--}}

    <div class="row" id="search-container">
        <div class="col-md-8">
            <div id="search-filter">
                <form id="frmMain" class="form-horizontal row" enctype="multipart/form-data"
                      action="{!! route('admin.search.quanhday') !!}" onsubmit="return false;">
                    <div class="col-sm-4 size-toggle">
                        <label class="col-sm-4 control-label">Tỉnh / TP</label>
                        <div class="col-sm-8">
                            <select name="dm_hc_tinh" id="dm_hc_tinh" class="form-control select2"
                                    data-source="{!! route('admin.category', ['type' => 'dm_hc_tinh']) !!}">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4 size-toggle">
                        <label class="col-sm-4 control-label">Loại BĐS</label>
                        <div class="col-sm-8">
                            <select name="dm_loai_bds" class="form-control select2"
                                    data-source="{!! route('admin.category', ['type' => 'dm_loai_bds']) !!}">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4 size-toggle">
                        <label class="col-sm-4 control-label">Kiểu BĐS</label>
                        <div class="col-sm-8">
                            <select name="dm_kieu_bds" class="form-control select2"
                                    data-source="{!! route('admin.category', ['type' => 'dm_kieu_bds']) !!}"></select>
                        </div>
                    </div>
                    <div class="col-sm-4 size-toggle">
                        <label class="col-sm-4 control-label">Q. / Huyện</label>
                        <div class="col-sm-8">
                            <select name="dm_hc_huyen" id="dm_hc_huyen" class="form-control select2"
                                    data-source-mode="short" data-source-parent="#dm_hc_tinh"
                                    data-source="{!! route('admin.category', ['type' => 'dm_hc_huyen']) !!}"></select>
                        </div>
                    </div>
                    <div class="col-sm-4 size-toggle">
                        <label class="col-sm-4 control-label">Xã / P.</label>
                        <div class="col-sm-8">
                            <select name="dm_hc_xa" class="form-control select2"
                                    data-source-mode="short" data-source-parent="#dm_hc_huyen"
                                    data-source="{!! route('admin.category', ['type' => 'dm_hc_xa']) !!}"></select>
                        </div>
                    </div>
                    <div class="col-sm-4 size-toggle">
                        <label class="col-sm-4 control-label">Số điểm</label>
                        <div class="col-sm-8">
                            <select name="so_diem" class="form-control select2">
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-4 control-label">Phạm vi</label>
                        <div class="col-sm-8">
                            <select name="pham_vi" class="form-control" id="radiusInput">
                                <option value="500">500m</option>
                                <option value="2000">2km</option>
                                <option value="5000">5km</option>
                                <option value="10000">10km</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-4 control-label">Sắp xếp</label>
                        <div class="col-sm-8">
                            <select name="sap_xep" class="form-control select2">
                                <option value="price-desc">Giá Cao - Thấp</option>
                                <option value="price-asc">Giá Thấp - Cao</option>
                                <option value="newest">Tin mới nhất</option>
                                <option value="oldest">Tin cũ nhất</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-sm-12 btn-group text-right">
                            <button id="search-button" type="button" class="btn btn-primary">
                                <i class="fa fa-map-marker"></i> Tìm quanh đây!
                            </button>
                            <button id="search-size" type="button" class="btn btn-info">
                                <i class="fa fa-arrows-alt"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="longtitude" id="longtitude">
                    <input type="hidden" name="latitude" id="latitude">
                </form>
            </div>
            <div id="search-map"></div>
        </div>
        <div class="col-md-4" id="search-result">
            <div style="margin-top:10px;"><em>Tìm thấy <span id="result-count">0</span> hồ sơ</em></div>
            <ul class="products-list product-list-in-box"></ul>
        </div>
    </div>

    <script>
        /* Item template */
        var itemTemplate =
            '<li class="item">\n' +
            '    <div class="product-img">\n' +
            '        <img src="{path}" alt="Product Image">\n' +
            '    </div>\n' +
            '    <div class="product-info">\n' +
            '        <a href="{!! route('admin.re.edit', ['id' => '']) !!}/{id}" class="product-title">{ten}\n' +
            '            <span class="label label-info pull-right">{giatri}</span></a>\n' +
            '        <span class="product-description">\n' +
            '          {diachi}\n' +
            '        </span>\n' +
            '    </div>\n' +
            '</li>';

        /* Contain Google Maps instance */
        var map = null;
        var markers = [];
        var markersInfo = [];

        function closeMarkersInfo()
        {
            for (var i = 0; i < markersInfo.length; i++) {
                markersInfo[i].close();
            }
        }

        /* Init map function */
        function initMap()
        {
            if (map != null) return;

            $(window).resize();

            $('#search-map').locationpicker({
                radius: 500,
                enableAutocomplete: false,
                zoom: 15,
                markerIcon: '{!! asset('spot.png') !!}',
                location: {
                    latitude: 10.0369368,
                    longitude: 105.7904502
                },
                inputBinding: {
                    latitudeInput: $('#latitude'),
                    longitudeInput: $('#longtitude'),
                    radiusInput: $('#radiusInput'),
                },
                oninitialized: function(component) {
                    map = $(component).locationpicker('map');

                    google.maps.event.addListener(map.map, 'click', closeMarkersInfo);
                },
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    var circle = $('#search-map').data('locationpicker').circle;
                    google.maps.event.addListener(circle, 'click', closeMarkersInfo);
                    map.map.fitBounds(circle.getBounds());
                },
            });
        }

        /* Bind load event */
        /*window.addEventListener("load", function()
        {

        }*/

        @push('footer')
        /* Start search when click button */
        $('#search-button').click(function() {
            var form = $('#frmMain');
            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    /* Clear old markers */
                    for (var k = 0; k <= markers.length; k++) {
                        typeof markers[k] === 'undefined' || markers[k].setMap(null);
                    }

                    markers = [];
                    markersInfo = [];

                    /* Clear result list */
                    $('#search-result ul').html('');

                    if (typeof data !== 'undefined') {
                        /* Update result count */
                        $('#result-count').html(data.length);

                        /* Render map markers & result list */
                        for (var i = 0; i < data.length; i++) {
                            data[i].path = data[i].path
                                ? '{!! asset('uploads') !!}/' + data[i].id + '/' + data[i].path
                                : '{!! asset('dist/img/default-50x50.gif') !!}';

                            /* Add marker to map */
                            var marker = new google.maps.Marker({
                                position: {lat: parseFloat(data[i].vt_latitude), lng: parseFloat(data[i].vt_longtitude)},
                                map: map.map,
                                title: data[i].ten,
                                icon: '{!! asset('dot.png') !!}'
                            });

                            var infowindow = new google.maps.InfoWindow({
                                maxWidth: 300,
                                content: '<div id="content">' +
                                '<h5 id="firstHeading" class="firstHeading">' + data[i].ten + '</h5>'+
                                '<div style="float:left; width:50px; height:50px; background-size:cover; background-image: url(' + data[i].path + ')"></div>'+
                                '<div id="bodyContent" style="float:right; width: calc(100% - 65px);">'+
                                '<p>' +
                                '<b>Giá trị:</b> ' + parseInt(data[i].giatri).toLocaleString() +
                                ' VNĐ</p><p><b>Khoảng cách:</b> ' + (data[i].khoang_cach / 1000).toFixed(1).toLocaleString() + ' km' +
                                '</p>'+
                                '</div>'+
                                '</div>'
                            });

                            marker.addListener('mouseover', function() {
                                infowindow.open(map, marker);
                            });

                            marker.addListener('mouseout', function() {
                                closeMarkersInfo();
                            });

                            markers.push(marker);
                            markersInfo.push(infowindow);

                            /* Add item to result list */
                            var newItem = itemTemplate.replace('{ten}', data[i].ten)
                                .replace('{id}', data[i].id)
                                .replace('{id_sp_hoso}', data[i].id)
                                .replace('{giatri}', parseInt(data[i].giatri).toLocaleString())
                                .replace('{path}', data[i].path)
                                .replace('{diachi}', data[i].diachi + ', ' + data[i].ten_duong + ', ' + data[i].ten_xa + ', ' + data[i].ten_huyen + ', ' + data[i].ten_tinh);

                            newItem = $(newItem);
                            /*newItem.find('a').click(function() {
                                closeMarkersInfo();
                                infowindow.open(map, marker);
                            });*/

                            $('#search-result ul').append(newItem);
                        }
                        /*$('#search-result').html(data[0].khoang_cach);*/
                    }
                },
            });

        });

        /* Auto resize elements */
        $(window).resize(function() {
            if (map != null) return;

            var searchMap = $('#search-container');

            if ($(window).width() >= 992) {
                var height = searchMap.parent().height();
                /*searchMap.height(height);*/
            } else {
                var height = 500;
            }

            searchMap.children().height(height);
            $('#search-map').height(height);
        });

        /* Document loaded event */
        $(document).ready(function() {
            /* Setup AJAX */
            $.ajaxSetup({ headers: {
                'X-CSRF-TOKEN': '{!! csrf_token() !!}'
            }});

            /* Close sidebar */
            $('.navbar .sidebar-toggle').click();

            /* Search Size Button */
            $('#frmMain > .size-toggle').toggle();

            $('#search-size').click(function() {
                $('#frmMain > .size-toggle').toggle();
            });

            initMap();
        });
        @endpush
        /*});*/

        /* Make sure map has loaded */
        /*document.addEventListener('DOMContentLoaded', function()
        {
            setTimeout(initMap, 1000);
            setInterval(initMap, 3000);
        }, false);*/
    </script>

@endsection