@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/kycpage.css') }}">

    <div class="container">

<h2 class="kycalert">Error: Your Account ID has already been verified.</h2>
    <div>
    <h5 style="text-align:center; margin-bottom: 50px;">If this is your first attempt to KYC, please contact our support: support@ineedadeveloper.com</h5>
    </div>
</div>
@endsection