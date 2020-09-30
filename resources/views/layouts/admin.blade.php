@php
    $setting = App\Setting::first();
@endphp
@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('exam_admin_header')
    <link rel="stylesheet" href="{{asset('css/exam/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    {{--<link rel="stylesheet" href="{{asset('css/exam/font-awesome.min.css')}}">--}}
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('css/exam/ionicons.min.css')}}">
    <!-- Admin Theme style -->
    {{--<link rel="stylesheet" href="{{asset('css/exam/AdminLTE.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('css/exam/skin-black.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('css/exam/fontawesome-iconpicker.min.css')}}">--}}
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{asset('css/exam/select2.min.css')}}">
    <!-- DataTable -->
    <link rel="stylesheet" href="{{asset('css/exam/datatables.min.css')}}">

    {{--<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">--}}
    <!-- Google Font -->
    {{--<link rel="stylesheet"--}}
    {{--href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">--}}
    <link rel="stylesheet" href="{{ asset('css/exam/admin.css?v=1') }}">
@endsection
@section('content')
    @if ($auth)
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if (Session::has('added'))
                <div class="alert alert-success sessionmodal">
                    {{session('added')}}
                </div>
            @elseif (Session::has('updated'))
                <div class="alert alert-info sessionmodal">
                    {{session('updated')}}
                </div>
            @elseif (Session::has('deleted'))
                <div class="alert alert-danger sessionmodal">
                    {{session('deleted')}}
                </div>
        @endif
        <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    {{$page_header}}
                    {{-- <small>Optional description</small> --}}
                </h1>
            </section>
            <!-- Main content -->
            <section class="content container-fluid">
                @yield('exam_admin_content')
            </section>
            <!-- /.content -->
        </div>
    </div>
    @endif
@endsection

@section('exam_admin_script')
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 3 -->

    {{--<script src="{{asset('js/exam/jquery.min.js')}}"></script>--}}
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('js/exam/bootstrap.min.js')}}"></script>
    <!-- DataTable -->
    <script src="{{asset('js/exam/datatables.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('js/select2.full.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/adminlte.min.js')}}"></script>

    <script src="{{asset('js/fontawesome-iconpicker.min.js')}}"></script>


    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


    <script>
        $(function () {
            $(document).ready(function () {
                $('.sessionmodal').addClass("active");
                setTimeout(function () {
                    $('.sessionmodal').removeClass("active");
                }, 4500);
            });

            $('#example1').DataTable({
                "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'csvHtml5',
                    'excelHtml5',
                    'colvis',
                ]
            });

            $('#questions_table').DataTable({
                "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'csvHtml5',
                    'excelHtml5',
                    'colvis',
                ],
                columnDefs: [
                    {targets: [7, 8, 9, 10], visible: false},
                ]
            });

            $('#search').DataTable({
                'paging': false,
                'lengthChange': false,
                'searching': true,
                'ordering': false,
                'info': false,
                'autoWidth': true,
                "sDom": "<'row'><'row'<'col-md-4'B><'col-md-8'f>r>t<'row'>",
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'excelHtml5',
                    'csvHtml5',
                    'colvis',
                ]
            });

            $('#topTable').DataTable({
                "order": [[5, "desc"]],
                "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'excelHtml5',
                    'csvHtml5',
                    'colvis',
                ]
            });
            //Initialize Select2 Elements
            $('.select2').select2()
            $('.currency-icon-picker').iconpicker({
                title: 'Currency Symbols',
                icons: ['fa fa-dollar', 'fa fa-euro', 'fa fa-gbp', 'fa fa-ils', 'fa fa-inr', 'fa fa-krw', 'fa fa-money', 'fa fa-rouble', 'fa fa-try'],
                selectedCustomClass: 'label label-primary',
                mustAccept: true,
                placement: 'topRight',
                showFooter: false,
                hideOnSelect: true
            });
        });


    </script>


    @if($setting->right_setting == 1)
        <script type="text/javascript" language="javascript">
            // Right click disable
            $(function () {
                $(this).bind("contextmenu", function (inspect) {
                    inspect.preventDefault();
                });
            });
            // End Right click disable
        </script>
    @endif

    @if($setting->element_setting == 1)
        <script type="text/javascript" language="javascript">
            //all controller is disable
            $(function () {
                var isCtrl = false;
                document.onkeyup = function (e) {
                    if (e.which == 17) isCtrl = false;
                }

                document.onkeydown = function (e) {
                    if (e.which == 17) isCtrl = true;
                    if (e.which == 85 && isCtrl == true) {
                        return false;
                    }
                };
                $(document).keydown(function (event) {
                    if (event.keyCode == 123) { // Prevent F12
                        return false;
                    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
                        return false;
                    }
                });
            });
            // end all controller is disable
        </script>

    @endif

    @yield('scripts')

@endsection