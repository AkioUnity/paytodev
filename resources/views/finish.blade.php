@extends('layouts.app')

@section('exam_head')
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="{{ asset('css/exam_app.css?v=1') }}" rel="stylesheet">
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
                <a title="Quick Quiz Home" class="tt" href="{{ url('/') }}"><h4 class="heading">Exam Result</h4></a>
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
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="home-main-block">

        @if($topic->show_ans==1)
        
         <div class="question-block">
            <h2 class="text-center main-block-heading">{{$topic->title}} ANSWER REPORT</h2>
            <table class="table table-bordered result-table">
              <thead>
                <tr>
                  <th>Question</th>                  
                  
                  <th style="color: green;">Correct Answer</th>
                  <th style="color: red;">Your Answer</th>
                  <th>Answer Explnation</th>
                </tr>
              </thead>
              <tbody>
                @php
                 $answers = App\Answer::where('topic_id',$topic->id)->where('user_id',Auth::user()->id)->get();
                @endphp             
               
                @php
                $x = $count_questions;               
                $y = 1;
                @endphp
                @foreach($answers as $key=> $a)
                
                  @if($a->user_answer != "0" && $topic->id == $a->topic_id)
                    <tr>
                      <td>{{ $a->question->question }}</td>
                      <td>{{ $a->answer }}</td>
                      <td>{{ $a->user_answer }}</td>
                      <td>{{ $a->question->answer_exp }}</td>
                    </tr>
                    @php                
                      $y++;
                      if($y > $x){                 
                        break;
                      }
                    @endphp
                  @endif
                @endforeach              
               
              </tbody>
            </table>
            
          </div>

          @endif



          <div class="question-block">
            <h2 class="text-center main-block-heading">{{$topic->title}}</h2>
            <table class="table table-bordered result-table">
              <thead>
                <tr>
                  <th>Total Questions</th>
                  <th>My Marks</th>
                  <th>Per Question Mark</th>
                  <th>Total Marks</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$count_questions}}</td>
                  <td>
                    @php
                      $mark = 0;
                      $correct = collect();
                    @endphp
                    @foreach ($answers as $answer)
                      @if ($answer->answer == $answer->user_answer)
                        @php
                        $mark++;
                        @endphp
                      @endif
                    @endforeach
                    @php
                      $correct = $mark*$topic->per_q_mark;
                    @endphp
                    {{$correct}}
                  </td>
                  <td>{{$topic->per_q_mark}}</td>
                  <td>{{$topic->per_q_mark*$count_questions}}</td>
                </tr>
              </tbody>
            </table>
            <h2 class="text-center">Thank You!</h2>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection

@section('exam_scripts')
  <script>
    $(document).ready(function(){
      history.pushState(null, null, document.URL);
      window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
      });
    });
  </script>
@endsection
