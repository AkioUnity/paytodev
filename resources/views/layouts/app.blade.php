@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 'extend.front-end.master' : 'front-end.master')

@section('content')
    <div id="app" style="position: relative;">
        @yield('exam_content')
    </div>
@endsection

@section('bootstrap_script')
    <!-- Scripts for Vue.js setting-->
    <script src="{{ asset('js/exam_app.js?v=1') }}"></script>
@stop
