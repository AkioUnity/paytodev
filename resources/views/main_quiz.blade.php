@extends('layouts.app')

@section('exam_head')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
                            @if($topic)
                                <h4 class="heading">{{$topic->title}}</h4>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            <!-- Right Side Of Navbar -->
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                                <li id="clock"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection

@section('exam_content')
    <div class="container">
        @if ($auth || true)
            <div class="home-main-block">
                <?php $users = App\Answer::where('topic_id', $topic->id)->where('user_id', Auth::user()->id)->first();
                $que = App\Question::where('topic_id', $topic->id)->first();
                ?>
                @if(!empty($users))
                    <div class="alert alert-danger">
                        You have already Given the test ! Try to give other Quizes
                    </div>
                @else
                    <div id="question_block" class="question-block">
                        <question :topic_id="{{$topic->id}}"></question>
                    </div>
                @endif
                @if(empty($que))
                    <div class="alert alert-danger">
                        No Questions in this quiz
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection

@section('exam_scripts')
    <!-- jQuery 3 -->
    {{--<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>--}}
    <!-- Bootstrap 3.3.7 -->
{{--    <script src="{{asset('js/bootstrap.min.js')}}"></script>--}}
    <script src="{{asset('js/jquery.cookie.js')}}"></script>
    <script src="{{asset('js/jquery.countdown.js')}}"></script>

    @if(empty($users) && !empty($que))
        <script>
            var topic_id = {{$topic->id}};
            var timer = {{$topic->timer}};
            $(document).ready(function () {
                function e(e) {
                    (116 == (e.which || e.keyCode) || 82 == (e.which || e.keyCode)) && e.preventDefault()
                }

                setTimeout(function () {
                    $(".myQuestion:first-child").addClass("active");
                    $(".prebtn").attr("disabled", true);
                }, 2500), history.pushState(null, null, document.URL), window.addEventListener("popstate", function () {
                    history.pushState(null, null, document.URL)
                }), $(document).on("keydown", e), setTimeout(function () {
                    $(".nextbtn").click(function () {
                        var e = $(".myQuestion.active");
                        $(e).removeClass("active"), 0 == $(e).next().length ? (Cookies.remove("time"), Cookies.set("done", "Your Quiz is Over...!", {
                            expires: 1
                        }), location.href = "{{$topic->id}}/finish") : ($(e).next().addClass("active"), $(".myForm")[0].reset(),
                            $(".prebtn").attr("disabled", false))
                    }),
                        $(".prebtn").click(function () {
                            var e = $(".myQuestion.active");
                            $(e).removeClass("active"),
                                $(e).prev().addClass("active"), $(".myForm")[0].reset()
                            $(".myQuestion:first-child").hasClass("active") ? $(".prebtn").attr("disabled", true) : $(".prebtn").attr("disabled", false);
                        })
                }, 700);
                var i, o = (new Date).getTime() + 6e4 * timer;
                if (Cookies.get("time") && Cookies.get("topic_id") == topic_id) {
                    i = Cookies.get("time");
                    var t = o - i,
                        n = o - t;
                    $("#clock").countdown(n, {
                        elapse: !0
                    }).on("update.countdown", function (e) {
                        var i = $(this);
                        e.elapsed ? (Cookies.set("done", "Your Quiz is Over...!", {
                            expires: 1
                        }), Cookies.remove("time"), location.href = "{{$topic->id}}/finish") : i.html(e.strftime("<span>%H:%M:%S</span>"))
                    })
                } else Cookies.set("time", o, {
                    expires: 1
                }), Cookies.set("topic_id", topic_id, {
                    expires: 1
                }), $("#clock").countdown(o, {
                    elapse: !0
                }).on("update.countdown", function (e) {
                    var i = $(this);
                    e.elapsed ? (Cookies.set("done", "Your Quiz is Over...!", {
                        expires: 1
                    }), Cookies.remove("time"), location.href = "{{$topic->id}}/finish") : i.html(e.strftime("<span>%H:%M:%S</span>"))
                })
            });
        </script>
    @else
        {{ "" }}
    @endif


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
@endsection
