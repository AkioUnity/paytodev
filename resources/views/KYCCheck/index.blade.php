@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/kycpage.css') }}">

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row kycmargin-sm"><h2>KYC Check Portal</h2></div>
                    </div>
                    <div class="col-md-6" style="margin-top:26px;">
                        @switch($info->status)
                            @case('unconfirmed')
                            <div class="dot-grey"></div>
                            @break
                            @case('Approved')
                            <div class="dot-success"></div>
                            @break
                            @case('Reject')
                            <div class="dot-danger"></div>
                            @break
                            @case('Pending')
                            <div class="dot-warning"></div>
                            @break
                        @endswitch
                    </div>
                </div>


                <div class="row kycmargin-sm"><p>If you have problem, please contact Tech Team via ZOHO.</p></div>
                <div class="row">
                    <div class="col-md-3 kycmargin-sm"><a href="{{route('kyc.refresh')}}" class=" btn btn-primary"
                                                          style="width: 120%">Refresh</a></div>
                    <div class="col-md-3 kycmargin-sm"><a href="{{route('kyc.getpending')}}" class="btn btn-primary"
                                                          style="width: 120%">Get Pending</a></div>
                </div>
            </div>

            <div class="col-md-6">

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8" style="margin-top:20px">
                        <div class="btn-group btn-group-justified">


                            @if ($info->nationality=='American' || $info->residence=='United States' || $info->us_citizen=='No')
                                <a href="" class="btn btn-success btn-block" disabled>Approve</a>
                            @else
                                <a href="{{route('kyc.approve', $info->id)}}"
                                   class="btn btn-success btn-block">Approve</a>
                            @endif

                            <a href="{{route('kyc.pending', $info->id)}}" class="btn btn-warning btn-block">Pending</a>
                            <a href="{{route('kyc.reject', $info->id)}}" class="btn btn-danger btn-block">Reject</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {!! Form::open(['action' => 'KycCheckController@updateNote']) !!}
                    <div class="col-md-4"></div>
                    <div class="col-md-6" style="margin-top:15px;">
                        {!! Form::textarea('comment',null,['placeholder' => "Enter your comment",'class'=>'form-control', 'rows' => 2]) !!}
                        {{ $info->note }}
                    </div>
                    <div class="col-md-2" style="margin-top:15px;">
                        {{ Form::submit('Save', ['class' => 'btn btn-default btn-block', 'style' => 'margin-left:-15px; width:120%; padding:15px;']) }}
                    </div>
                    {!! Form::close() !!}
                </div>

                <br>


            </div>
        </div>
        <hr>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Acount ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Identity</th>
                <th>Passport or ID Card</th>
                <th>Magnifier</th>


            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $info->account_id }}</td>
                <td>{{ $info->firstname }}</td>
                <td>{{ $info->lastname }}</td>
                <td>{{ $info->id_number }}</td>
                <td>
                    <div class="img-zoom-container">
                        <img src={{ $info->pic_passport[0] }} id="myimage" class="img-rounded" alt="Passport not found"
                             width={{ $info->pic_passport['width'] }} height={{ $info->pic_passport['height'] }}>
                    </div>
                </td>
                <td>
                    <div id="myresult" class="img-zoom-result"></div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Sex</th>
            <th>Date of Birth</th>
            <th>Nationality</th>
            <th>Residence</th>
            <th>U.S. Citizen</th>
            <th>Self-Portrait</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $info->sex }}</td>
            <td>{{ $info->birthday }}</td>

            @if ($info->nationality!='American')
                <td style="list-style-type:disc; color:green;"><b>{{ $info->nationality }} <span>&#10004;</span></b>
                </td>
            @else
                <td style="list-style-type:disc; color:darkred;"><b>{{ $info->nationality }} <span>&#10008;</span></b>
                </td>
            @endif

            @if ($info->residence!='United States')
                <td style="list-style-type:disc; color:green;"><b>{{ $info->residence }} <span>&#10004;</span></b></td>
            @else
                <td style="list-style-type:disc; color:darkred;"><b>{{ $info->residence }} <span>&#10008;</span></b>
                </td>
            @endif

            @if ($info->us_citizen=='Yes')
                <td style="list-style-type:disc; color:green;"><b>{{ $info->us_citizen }} <span>&#10004;</span></b></td>
            @else
                <td style="list-style-type:disc; color:darkred;"><b>{{ $info->us_citizen }} <span>&#10008;</span></b>
                </td>
            @endif

            <td>
                <img src={{ $info->pic_portrait }} alt="Portrait not found" style="max-width:300px; max-height:300px">
            </td>

        </tr>
        </tbody>

    </table>

    <hr>

    @if ($info->pre==0)
        <a href="" class="btn btn-primary">Previous<span class="badge kycmargin-sm">{{$info->pre}}</span></a>

    @else
        <a href="{{route('getprevious',$info->id)}}" class="btn btn-primary">Previous<span
                    class="badge kycmargin-sm">{{$info->pre}}</span></a>

    @endif

    @if ($info->post==0)
        <a href="" class="btn btn-primary" style="float: right;">Next<span
                    class="badge kycmargin-sm">   {{$info->post}}</span></a>

    @else
        <a href="{{route('getnext',$info->id)}}" class="btn btn-primary" style="float: right;">
            Next
            <span class="badge kycmargin-sm">
                {{$info->post}}
            </span>
        </a>
    @endif
@endsection

@section('exam_admin_script')
    <script>
        // Initiate zoom effect:
        imageZoom("myimage", "myresult");
    </script>
@endsection
