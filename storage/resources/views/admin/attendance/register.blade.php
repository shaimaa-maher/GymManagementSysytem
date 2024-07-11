@extends('layouts.backend')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="">Registeration</a></li>
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

    <div>
        <h2> 
          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
          </svg> 
          Registration
        </h2>
    </div>

    <div class="row m-auto member">  
           <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"> <i class="fa fa-pen"></i>  Register Member </button> -->
           <form method="POST" action="{{route('register.memebers')}}" enctype="multipart/form-data" class="form-inline">
                 @csrf         
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control @error('barcode') is-invalid @enderror mr-sm-2" name="barcode" value="" placeholder="Register Members" required>
                            @error('barcode')
                        <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                    </div>                                  
                </div>
            </form>
           <div class="col-md-3">
                <button type="button" class="btn btn-info ml-4" data-toggle="modal" data-target="#modal-sub"><i class="fa fa-pen"></i> Daily Subscription </button>
           </div>
           
           <div class="ml-5">
                <form class="form-inline" action="{{route('attendance.register')}}" method="get">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
           </div>

            <table class="table table-hover table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Sessions no.</th>
                        <th>Barcode</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                    <tr>
                        <td>{{$member->member_id}}</td>
                        <td>{{$member->member->name}}</td>
                        <td>{{$member->member->sessionsNumber}}</td>
                        <td>{{$member->member->barcode_number}}</td>
                        <td>{{$member->created_at->toDateString()}}</td>
                        <td>{{$member->created_at->format('g:i A')}}</td> 
                        <td><a class="btn btn-primary btn-sm" href="{{route('profile',$member->member_id)}}"><i class="fa fa-eye"></i> Show</a></td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>

             <!--ADD STAFF IMAGES MODAL-->
             <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Register</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form method="POST" action="{{route('register.memebers')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Barcode</label>
                                            <input type="text" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="" required>
                                                @error('barcode')
                                                <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Register</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            <!--END OF ADD STAFF IMAGES MODAL-->


             <!--ADD Subscription-->
             <div class="modal fade" id="modal-sub">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Subscription</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form method="POST" action="{{route('register.dailySubscription')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="number" class="form-control @error('barcode') is-invalid @enderror" name="amount" value="">
                                                @error('amount')
                                                <div class="alert alert-danger">{{$message}}</div>
                                                @enderror  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            <!--END OF ADD STAFF IMAGES MODAL-->
           
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
</style>

@endsection