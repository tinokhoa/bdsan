<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('page_title', 'Welcome') / {!! env('APP_NAME') !!}</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{url('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{url('dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{url('dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/iCheck/square/blue.css')}}">
    <link rel="stylesheet" href="{{url('plugins/jquery-confirm/jquery-confirm.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/pnotify/dist/pnotify.css') }}">
    <link rel="stylesheet" href="{{url('plugins/pnotify/dist/pnotify.buttons.css') }}">
    <link rel="stylesheet" href="{{url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,600,700,300italic,400italic,600italic" />

    <style>
        body { font-family: 'Roboto', Arial, sans-serif; font-size: 12px; }
        .treeview-menu>li>a { font-size: 12px; }
        .ui-pnotify-text { font-size: 12px; }
        .select2 { width: 100%!important; }
        .nav-tabs .dropdown-menu, .select2-dropdown { box-shadow: 0 10px 50px rgba(0,0,0,0.5); }
        .datepicker-dropdown { box-shadow: 0 0 50px rgba(0,0,0,0.5); }
        .select2-container .select2-selection--single { height: 34px; }
        .nav-tabs-custom>.nav-tabs>li>button {
            background: #00a65a;
            color: white;
            border-radius: 5px;
            padding: 8px 25px;
            outline: none;
            border: none;
        }
        .select2-container + select {
            position:absolute;
            display: block !important;
            visibility: hidden;
            height: 1px;
            margin-left: 10px;
            margin-top: -14px;
        }
        .select2-hidden-accessible { top: 50px; }
        #img-container, #file-container-table { margin-top: 10px; }
        #img-container .img {
            margin-bottom: 10px;
            position: relative;
            width: 100%;
            height:140px;
            background-size: cover;
        }
        #img-container .img .btn {
            position: absolute;
            top: 5px;
            right: 5px;
        }
        .content-wrapper .nav>li>a { padding: 10px; }
        #search-filter {
            position: absolute;
            z-index: 1;
            background: white;
            width: calc(100% - 85px);
            margin-left: 0;
            padding-left: 15px;
            margin-top: 0;
            padding: 15px 15px 0 15px;
            border-radius: 0 0 10px 0;
            box-shadow: 0 0 10px rgba(0,0,0,0.4);
            font-size: 10px;
            /*opacity: 0.7;
            -webkit-transition: opacity 0.2s;
            -moz-transition: opacity 0.2s;
            -ms-transition: opacity 0.2s;
            -o-transition: opacity 0.2s;
            transition: opacity 0.2s;*/
        }
        /*#search-filter:hover { opacity: 1; }*/
        #search-filter [class*="col-"] { margin-bottom: 5px; }
        @media (min-width: 768px) {
            .sidebar-collapse .treeview .treeview-menu {
                margin-top: -3px !important;
            }
        }
        #search-result { overflow-y: scroll; }
        @media (min-width: 768px) {
            #search-result > * {
                margin-left: -15px;
                /*margin-right: 15px;*/
            }
        }
        #search-result .products-list .item { background: none; }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        @include('admin.header')
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        @include('admin.sidebar')
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; {!! date('Y') !!} <a href="{!! route('admin.dashboard') !!}">{!! env('APP_NAME') !!}</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="{!! url('bower_components/jquery/dist/jquery.min.js') !!}"></script>
<script src="{!! url('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
<script src="{!! url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') !!}"></script>
<script src="{!! url('bower_components/fastclick/lib/fastclick.js') !!}"></script>
<script src="{!! url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}"></script>
<script src="{!! url('bower_components/moment/min/moment.min.js') !!}"></script>
<script src="{!! url('plugins/jquery-confirm/jquery-confirm.min.js') !!}"></script>
<script src="{!! url('plugins/pnotify/dist/pnotify.js') !!}"></script>
<script src="{!! url('plugins/pnotify/dist/pnotify.buttons.js') !!}"></script>
<script src="{!! url('plugins/input-mask/jquery.inputmask.js') !!}"></script>
<script src="{!! url('plugins/input-mask/jquery.inputmask.extensions.js') !!}"></script>
<script src="{!! url('plugins/input-mask/jquery.inputmask.date.extensions.js') !!}"></script>
<script src="{!! url('plugins/input-mask/jquery.inputmask.regex.extensions.js') !!}"></script>
<script src="{!! url('plugins/input-mask/jquery.inputmask.numeric.extensions.js') !!}"></script>
<script src='http://maps.google.com/maps/api/js?libraries=places&key={!! config('map.google_map_key') !!}'></script>
<script src="{!! url('plugins/jquery-locationpicker/dist/locationpicker.jquery.min.js') !!}"></script>
<script src="{!! url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{!! url('dist/js/adminlte.min.js') !!}"></script>
<script>

    /**
     * Active current sidebar menu
     */
    (function() {
        var url = location.href;
        var bestMatch = null;

        $('.sidebar-menu a').each(function() {
            var current = $(this);

            if (url.indexOf(current.attr('href')) == 0) {
                if (bestMatch == null || bestMatch.attr('href').length < current.attr('href').length) {
                    bestMatch = current;
                }
            }
        });

        if (bestMatch != null) {
            bestMatch.addClass('active');
            bestMatch.parents('li').addClass('active');
        }
    })();


    /**
     * Fix select2 auto expand on focus
     */
    $(document).on('focus', '.select2', function() {
        $(this).siblings('select').select2('open');
    });


    /**
     * Auto active tab by #hash
     */
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
    }


    /**
     * Append #hash to url when active a tab
     */
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        var offsetTop = $(window).scrollTop();
        var offsetLeft = $(window).scrollLeft();

        window.location.hash = e.target.hash;
        window.scrollTo(offsetLeft, offsetTop);
    });


    /**
     * Auto load data for select
     */
    function initDataSource(element)
    {
        var element = $(element);
        var elementParent = null;
        var dataUrl = element.data('source');
        var dataMode = element.data('source-mode');
        var dataParent = element.data('source-parent');

        if (typeof dataUrl === 'undefined') return;

        var isSelect2 = element.hasClass('select2');
        var refresher = $('<a href="javascript:void(0)" class="data-source-refresher"><i class="fa fa-refresh"></i></a>');
        var prevElement = element.prev();

        if (typeof dataParent !== 'undefined') {
            var elementParent = $(dataParent);

            elementParent.change(function() {
                refresher.click();
            });
        }

        if (typeof prevElement != 'undefined') {
            prevElement.find('.data-source-refresher').remove();
            prevElement.append('&nbsp;&nbsp;');
            prevElement.append(refresher);
        }

        refresher.click(function() {
            var currentValue = element.val();
            var params = '';

            if (elementParent !== null && elementParent.val()) {
                params = '?parent=' + elementParent.val();
            }

            $.getJSON(dataUrl + params, function(data) {
                if (isSelect2) {
                    /* If select2 initialized, then destroy before */
                    if (element.data('select2')) {
                        element.select2('destroy');
                    }

                    /* Empty current select */
                    element.html('<option value="">------</option>');

                    for (var k in data) {
                        if (typeof dataMode === 'undefined' || dataMode !== 'short') {
                            if (typeof data[k].text1 !== 'undefined') {
                                data[k].text = data[k].text1 + ' / ' + data[k].text;
                            }

                            if (typeof data[k].text2 !== 'undefined') {
                                data[k].text = data[k].text2 + ' / ' + data[k].text;
                            }
                        }

                        if (data[k].id == currentValue) {
                            element.append('<option value="' + data[k].id + '" selected="selected">' + data[k].text + '</option>');
                        }
                        else {
                            element.append('<option value="' + data[k].id + '">' + data[k].text + '</option>');
                        }
                    }

                    element.change();
                    element.select2();
                }
            });
        }).click();
    }


    $('select[data-source]').each(function(idx) {
        initDataSource(this);
    });


    function unmask()
    {
        /*$('.inputmask-float').unmask();
        $('.inputmask-integer').unmask();*/
    }


    /**
     * Init: Siebar menu, Select2, DatePicker, InputMask
     */
    $(document).ready(function () {
        $('.sidebar-menu').tree();
        $('.select2').select2();

        $('.datepicker')
            .datepicker({ autoclose: true, format: 'yyyy/mm/dd' })
            .inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' });

        $('.inputmask-float').inputmask({
            alias: 'decimal',
            groupSeparator: ',',
            autoGroup: true,
            allowPlus: false,
            allowMinus: false,
            removeMaskOnSubmit:true});

        $('.inputmask-integer').inputmask({
            alias: 'integer',
            groupSeparator: ',',
            autoGroup: true,
            allowPlus: false,
            allowMinus: false,
            removeMaskOnSubmit:true });
    });


    $("a.confirmation").on("click", function(e) {
        var link = this;

        e.preventDefault();

        $.confirm({
            title: 'Xác nhận',
            content: $(this).data('confirm'),
            icon: 'fa fa-question-circle',
            animation: 'scale',
            closeAnimation: 'scale',
            opacity: 0.5,
            buttons: {
                'confirm': {
                    text: 'Đồng ý',
                    btnClass: 'btn-blue',
                    action: function () {
                        window.location = link.href;
                    }
                },
                cancel: {
                    text: 'Không'
                }
            }
        });
    });


    /**
     * Show flash messages
     */
    @foreach ( [ 'error', 'success', 'warning' ] as $flashType )
        @if( Session::has( 'flash-' . $flashType ) )
            new PNotify({
                text: '{{ Session::get('flash-' . $flashType) }}',
                type: '{!! $flashType !!}',
                styling: 'bootstrap3'
            });
        @endif
    @endforeach

    @stack('footer')

</script>
</body>
</html>
