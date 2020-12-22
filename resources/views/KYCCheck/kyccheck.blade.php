<!DOCTYPE html>
<html lang="en">
<head>
  <title>KYC Check Portal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/kycpage.css') }}"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container-fluid" style = "width: 95%">

        <h2>KYC Check Portal</h2>
        <p>If you have problem, please contact Tech Team via ZOHO.</p>
        <a href="{{route('kyc.refresh')}}" class= "btn btn-primary"style= width: 20%">Refresh</a>
        <a href="{{route('kyc.getpending')}}" class= "btn btn-primary"style= width: 20%">Get Pending</a>
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
        <th>Verification</th>
        <th>Status</th>
        <th>Note</th>
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
            <img src={{ $info->pic_passport[0] }} id="myimage" class="img-rounded" alt="Passport not found" width={{ $info->pic_passport['width'] }} height={{ $info->pic_passport['height'] }}>

        </td>
        <td>
            <div id="myresult" class="img-zoom-result"></div>
            </div>
        </td>

        <td>
            {{-- {!! Form::open(['route' => 'kyccheck.status']) !!} --}}
            <a href="{{route('kyc.approve', $info->id)}}" class= "btn btn-success">Approve</a>
            </form>
        </td>
        <td>
            {{ $info->status }}   
        </td>
        <td>
            {!! Form::open(['action' => 'KycCheckController@updateNote']) !!}
                <textarea class="form-control" id="comment" placeholder="Enter your comment" name="comment"></textarea>
                {{ $info->note }}
                <br>
                {{ Form::submit('Save', ['class' => 'btn btn-primary btn-block','name' => 'status']) }}
            {!! Form::close() !!}
        
                    <div class="col-md-6" style = "margin-top:5px" >
                <a href="{{route('kyc.pending', $info->id)}}" class= "btn btn-warning btn-block"style="margin-left :-15px; width: 135%">Pending</a>
            </div>
                    <div class="col-md-6" style = "margin-top:5px">
                <a href="{{route('kyc.reject', $info->id)}}" class= "btn btn-danger btn-block"style="margin-left :-15px;  width: 135%" >Reject</a>
            </div>
        </td>
    </tr>
    </tbody>
  </table>

  <table class="table table-striped">
        <thead>
                <tr>
                  <th>Acount ID</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Identity</th>
                  <th>Passport or ID Card</th>
                  <th>Self-Portrait</th>
                  <th>Verification</th>
                  <th>Status</th>
                  <th>Note</th>
                </tr>
              </thead>
  </table>
  
<a href="{{route('getprevious',$info->id)}}" class= "btn btn-default">previous</a>
<a href="{{route('getnext',$info->id)}}" class= "btn btn-default">next</a>

</div>
</div>

<script>
        function imageZoom(imgID, resultID) {
          var img, lens, result, cx, cy;
          img = document.getElementById(imgID);
          result = document.getElementById(resultID);
          /*create lens:*/
          lens = document.createElement("DIV");
          lens.setAttribute("class", "img-zoom-lens");
          /*insert lens:*/
          img.parentElement.insertBefore(lens, img);
          /*calculate the ratio between result DIV and lens:*/
          cx = result.offsetWidth / lens.offsetWidth;
          cy = result.offsetHeight / lens.offsetHeight;
          /*set background properties for the result DIV:*/
          result.style.backgroundImage = "url('" + img.src + "')";
          result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
          /*execute a function when someone moves the cursor over the image, or the lens:*/
          lens.addEventListener("mousemove", moveLens);
          img.addEventListener("mousemove", moveLens);
          /*and also for touch screens:*/
          lens.addEventListener("touchmove", moveLens);
          img.addEventListener("touchmove", moveLens);
          function moveLens(e) {
            var pos, x, y;
            /*prevent any other actions that may occur when moving over the image:*/
            e.preventDefault();
            /*get the cursor's x and y positions:*/
            pos = getCursorPos(e);
            /*calculate the position of the lens:*/
            x = pos.x - (lens.offsetWidth / 2);
            y = pos.y - (lens.offsetHeight / 2);
            /*prevent the lens from being positioned outside the image:*/
            if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
            if (x < 0) {x = 0;}
            if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
            if (y < 0) {y = 0;}
            /*set the position of the lens:*/
            lens.style.left = x + "px";
            lens.style.top = y + "px";
            /*display what the lens "sees":*/
            result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
          }
          function getCursorPos(e) {
            var a, x = 0, y = 0;
            e = e || window.event;
            /*get the x and y positions of the image:*/
            a = img.getBoundingClientRect();
            /*calculate the cursor's x and y coordinates, relative to the image:*/
            x = e.pageX - a.left;
            y = e.pageY - a.top;
            /*consider any page scrolling:*/
            x = x - window.pageXOffset;
            y = y - window.pageYOffset;
            return {x : x, y : y};
          }
        }
        </script>

<script>
// Initiate zoom effect:
imageZoom("myimage", "myresult");
</script>

</body>
</html>
