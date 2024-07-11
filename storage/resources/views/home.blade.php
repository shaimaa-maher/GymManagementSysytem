@extends('layouts.backend')

@section('content')

<!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
          <div class="row">
              <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>Registeration</h3>
                      <h5>
                      <i class="fa fa-id-card"></i>
                      </h5>
                    </div>
                    <a href="{{route('attendance.register')}}" class="small-box-footer">Start <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->

              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>MEMBERS</h3> 
                    @if(!empty($total))
                        <h5>{{$total}}</h5>
                    @endif
                  </div>
                  
                  <a href="{{route('members.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>Total Revenue</h3>
                    <h5>{{$totalCost}} 
                        &nbsp;
                        E.L</5>
                  </div>
                  <a href="{{route('finance')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
          </div>
          <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
  </section>
<!-- /.content -->

  <section>
    <div class="content mt-5"> 
          <h5><b>Today's</b> Revenue :</h5>     
          <div class="row mt-3 flex justify-content-lg-around">
            
              <div class="col-sm-3 mb-3 mb-sm-0">
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
                    <h5 class="card-text mt-4">{{$data['sessions']}}  <i class='fa fa-pound-sign'></i></h5>
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
  </section>

<style>
  h4{
    color:#FFC107;
  }

</style>
  
@endsection
