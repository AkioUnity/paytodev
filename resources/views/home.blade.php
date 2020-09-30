@extends('layouts.app')

@section('exam_head')
  <link href="{{ asset('css/exam_app.css?v=1') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
@endsection

@section('exam_top_bar')
  <nav class="navbar navbar-default navbar-static-top">
    <div class="nav-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="navbar-header">
              <!-- Branding Image -->
              @if($setting)
                <a class="tt" title="Quick Quiz Home" href="{{url('/')}}"><h4 class="heading">{{$setting->welcome_txt}}</h4></a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
@endsection

@section('exam_content')
<div class="container">
  @if ($auth)
    <div class="quiz-main-block">
      <div class="row">
        @if ($topics)
          @foreach ($topics as $topic)
            <div class="col-md-4">
              <div class="topic-block">
                <div class="card blue-grey darken-1">
                  <div class="card-content white-text">
                    <span class="card-title">{{$topic->title}}</span>
                    <p title="{{$topic->description}}">{{str_limit($topic->description, 120)}}</p>
                    <div class="row">
                      <div class="col-xs-7 pad-0">
                        <ul class="topic-detail">
                          <li>Per Question Mark <i class="fa fa-long-arrow-right"></i></li>
                          <li>Total Marks <i class="fa fa-long-arrow-right"></i></li>
                          <li>Total Questions <i class="fa fa-long-arrow-right"></i></li>
                          <li>Total Time <i class="fa fa-long-arrow-right"></i></li>
                          <li>Quiz Price <i class="fa fa-long-arrow-right"></i></li>
                        </ul>
                      </div>
                      <div class="col-xs-5">
                        <ul class="topic-detail right">
                          <li>{{$topic->per_q_mark}}</li>
                          <li>
                            @php
                                $qu_count = 0;
                            @endphp
                            @foreach($questions as $question)
                              @if($question->topic_id == $topic->id)
                                @php 
                                  $qu_count++;
                                @endphp
                              @endif
                            @endforeach
                            {{$topic->per_q_mark*$qu_count}}
                          </li>
                          <li>
                            {{$qu_count}}
                          </li>
                          <li>
                            {{$topic->timer}} minutes
                          </li>

                          <li class="amount">
                            @if(!empty($topic->amount))
                            {{-- <i class="{{$setting->currency_symbol}}"></i> {{$topic->amount}}   --}}
                             @else
                               Free
                            @endif
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>


               <div class="card-action text-center">
                  
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

                    @if($auth->topic()->where('topic_id', $topic->id)->exists())
                      <a href="{{route('start_quiz', ['id' => $topic->id])}}" class="btn btn-block" title="Start Quiz">Start Quiz </a>
                    @else
                      {!! Form::open(['method' => 'POST', 'action' => 'PaypalController@paypal_post']) !!} 
                        {{ csrf_field() }}
                        <input type="hidden" name="topic_id" value="{{$topic->id}}"/>
                         @if(!empty($topic->amount)) 

                        <button type="submit" class="btn btn-default">Pay  <i class="{{$setting->currency_symbol}}"></i>{{$topic->amount}}</button>
                          @else 

                          <a href="{{route('start_quiz', ['id' => $topic->id])}}" class="btn btn-block" title="Start Quiz">Start Quiz </a>

                        @endif

                      {!! Form::close() !!}
                    @endif
                  </div>


                {{--   <div class="card-action">
                    @php 
                      $a = false;
                      $que_count = $topic->question ? $topic->question->count() : null;
                      $ans = $auth->answers;
                      $ans_count = $ans ? $ans->where('topic_id', $topic->id)->count() : null;
                      if($que_count && $ans_count && $que_count == $ans_count){
                        $a = true;
                      }
                    @endphp
                    <a href="{{$a ? url('start_quiz/'.$topic->id.'/finish') : route('start_quiz', ['id' => $topic->id])}}" class="btn btn-block" title="Start Quiz">Start Quiz
                    </a>
                  </div> --}}
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  @endif
</div>


@endsection

@section('exam_scripts')

<script>
   $( document ).ready(function() {
       $('.sessionmodal').addClass("active");
       setTimeout(function() {
           $('.sessionmodal').removeClass("active");
      }, 4500);
    });
</script>


 @if($setting->right_setting == 1)
  <script type="text/javascript" language="javascript">
   // Right click disable
    $(function() {
    $(this).bind("contextmenu", function(inspect) {
    inspect.preventDefault();
    });
    });
      // End Right click disable
  </script>
@endif

@if($setting->element_setting == 1)
<script type="text/javascript" language="javascript">
//all controller is disable
      $(function() {
      var isCtrl = false;
      document.onkeyup=function(e){
      if(e.which == 17) isCtrl=false;
}

      document.onkeydown=function(e){
       if(e.which == 17) isCtrl=true;
      if(e.which == 85 && isCtrl == true) {
     return false;
    }
 };
      $(document).keydown(function (event) {
       if (event.keyCode == 123) { // Prevent F12
       return false;
  }
      else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
     return false;
   }
 });
});
     // end all controller is disable
 </script>


@endif
@endsection
