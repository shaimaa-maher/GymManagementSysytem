@extends('layouts.backend')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="">Finance</a></li>
@endsection
@section('content')

@if(session('success'))
  <div class="alert alert-success" id="successMessage">
    {{session('success')}}
  </div>
@endif

@if(session('failed'))
<div class="alert alert-danger" id="failedMessage">
  {{session('failed')}}
</div>
@endif

<script>
  setTimeout(
      function(){
        $("#successMessage").delay(3000).fadeOut('fast');
      },1000
    );
    
  setTimeout(
      function(){
        $("#failedMessage").delay(3000).fadeOut('fast');
      },1000

    );
</script>

  <h2><i class="fas fa-landmark"></i><span> Finance</span>
  </h2>


<div class="content mt-5"> 
  <h5><b>Today's</b> Revenue :</h5>     
    <div class="row mt-3 flex justify-content-lg-around">
       
        <div class="col-sm-2 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h4>Total</h4 >
              <h5 class="card-text mt-4">{{$data['totalToday']}}  <i class='fa fa-pound-sign'></i></h5>
            </div>
          </div>
        </div>

        <div class="col-sm-3 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h4>Daily Subscription</h4 >
              <h5 class="card-text mt-4">{{$data['dailySubToday']}}  <i class='fa fa-pound-sign'></i></h5>
            </div>
          </div>
        </div>

        
        <div class="col-sm-3 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h4>Member Subscription</h4 >
              <h5 class="card-text mt-4">{{$data['memberSubToday']}}  <i class='fa fa-pound-sign'></i></h5>
            </div>
          </div>
        </div>

        <div class="col-sm-3 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h4>Sessions</h4 >
              <h5 class="card-text mt-4">{{$data['memberSessionToday']}}<i class='fa fa-pound-sign'></i></h5>
            </div>
          </div>
        </div>

    </div>
</div> 


<div class="content mt-5"> 
  <h5>This <b>Week</b> Revenue :</h5>     
    <div class="row mt-3 flex justify-content-lg-around">
       
        <div class="col-sm-2 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h4>Total</h4 >
              <h5 class="card-text mt-4">{{$data['totalWeek']}}  <i class='fa fa-pound-sign'></i></h5>
            </div>
          </div>
        </div>

        <div class="col-sm-3 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h4>Daily Subscription</h4 >
              <h5 class="card-text mt-4">{{$data['dailySubWeek']}}  <i class='fa fa-pound-sign'></i></h5>
            </div>
          </div>
        </div>

        
        <div class="col-sm-3 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h4>Member Subscription</h4 >
              <h5 class="card-text mt-4">{{$data['memberSubWeek']}}  <i class='fa fa-pound-sign'></i></h5>
            </div>
          </div>
        </div>

        <div class="col-sm-3 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h4>Sessions</h4 >
              <h5 class="card-text mt-4">{{$data['memberSessionWeek']}}<i class='fa fa-pound-sign'></i></h5>
            </div>
          </div>
        </div>

    </div>
</div> 



<div class="content mt-5"> 
  <h5>This <b>Month</b> Revenue :</h5>     
    <div class="row mt-3 flex justify-content-lg-around">
       
        <div class="col-sm-2 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h4>Total</h4 >
              <h5 class="card-text mt-4">{{$data['totalMonth']}}  <i class='fa fa-pound-sign'></i></h5>
            </div>
          </div>
        </div>

        <div class="col-sm-3 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h4>Daily Subscription</h4 >
              <h5 class="card-text mt-4">{{$data['dailySubMonth']}}  <i class='fa fa-pound-sign'></i></h5>
            </div>
          </div>
        </div>

        
        <div class="col-sm-3 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h4>Member Subscription</h4 >
              <h5 class="card-text mt-4">{{$data['memberSubMonth']}}  <i class='fa fa-pound-sign'></i></h5>
            </div>
          </div>
        </div>

        <div class="col-sm-3 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h4>Sessions</h4 >
              <h5 class="card-text mt-4">{{$data['memberSessionMonth']}}<i class='fa fa-pound-sign'></i></h5>
            </div>
          </div>
        </div>

    </div>
</div> 





<style>
  h4{
    color:#FFC107;
  }

</style>


@endsection