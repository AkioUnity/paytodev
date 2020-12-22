@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/kycpage.css') }}">

    <div class="container">
        <h2 class="kycalert">Your KYC process has been successful.</h2>
    </div>

@endsection