@extends('layouts.backend')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="">Attendance</a></li>
<li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
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

    <div> 
        <h2> 
          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z"/>
          </svg> Attendance
        </h2>
    </div>
    
    <div class="row m-auto member">

          <div>
              <form class="form-inline" action="{{route('attendance')}}" method="get">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                  <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
              </form>
          </div>

          <div class="col-md-5 ml-auto">
            <!-- filter beased on the date  -->
              <form action="{{route('attendance')}}" class="form-inline ml-2 right-0" method="get">
                  <div class="form-group mb-2">
                    <label for="date" class="">From:</label>
                    <input type="date" class="datePicker form-control" name="start">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="date" class="">To:</label>
                    <input type="date" class="datePicker form-control" name="end" >
                  </div>
                 <button type="submit" class="btn btn-primary mb-2">Filter</button>
              </form>
          </div> 
                      
          <table class="table table-hover table-bordered mt-4 col-12 col-md-12 col-sm-12" id="attendance_table">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Barcode</th>
                          <th>Sessions no.</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  
                  <tbody>
                      @foreach($members as $member)
                        <tr>
                          <td>{{$member->member->name}}</td>
                          <td>{{$member->member->barcode_number}}</td>
                          <td>{{$member->member->sessionsNumber}}</td>
                          <td>
                              {{$member->created_at->toDateString()}}
                          </td>
                          <td>
                              {{$member->created_at->format('g:i A')}}
                          </td>
                          <td>
                            <a class="btn btn-primary btn-sm" href="{{route('profile',$member->member_id)}}"><i class="fa fa-eye"></i> Show</a>       
                          </td>
                        </tr>
                      @endforeach
                      
                  </tbody>
          </table>
          
          {!! $members->appends(request()->input())->links()!!}
    </div>


<style type="text/css">
  .member{
      background-color:white;
      width:100%;
      padding:1.5rem;
      border-radius:15px;
    }

  

  .members {
      width:100%;
      border: 1px solid #b5b5b5;
      border-radius: 4px;
      box-sizing: border-box;
      box-shadow: 0 2px 1px rgba(0,0,0,.07);
  }


  .datePicker{
    width:15rem;
    height: 2.5rem;
    margin-left: 1rem;
    padding-left:0.8rem;
    padding-right:0.8rem;
    border:1px solid #bab8b8; 
    border-radius:4px;
    color:#bab8b8;

  }

  .datePicker:focus {
    outline:none;
    border-color:#3acfff;
    box-shadow:0 0 0 0.25rem rgba(0, 120, 250, 0.1);
  }

</style>
@endsection