@extends('layouts.backend')

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

<div class="mx-4">
  <div class="row justify-content-around">
    <div class="card-profile col-md-3  px-2">
      <div class="card p-3 ">
        <img src="{{asset('public/images/Profile.png')}}" class="card-img-top rounded-circle">
        <div class="card-body">
        <h4><b>Coach:</b> {{$trainer->name}}</h4>
        <h4><b>Hours:</b> {{$trainer->working_hours}}</h4>
        <h4><b>class:</b> {{$trainer->class}}</h4>
        
          <a class="btn btn-primary mt-4 btn-info" data-bs-toggle="collapse" href="#memberstable" role="button" aria-expanded="false" aria-controls="collapseExample">
            Assigned Members
          </a>

          <a class="btn btn-primary mt-4 btn-warning" data-bs-toggle="collapse" href="#attendance" role="button" aria-expanded="false" aria-controls="collapseExample">
            Attendance Details
          </a>
        
        </div>
      </div>
    </div>

    <div class="card-details col-md-8">
      <h3 class="text-warning pt-4 px-4">Account Details</h3>
      <div class="row g-3 justify-content-around">
        <div class="col-md-5 pb-4">
          <label for="inputPassword4" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="inputPassword4"  value="{{$trainer->name}}" name="name" readonly> 
        </div>

        <div class="col-md-5 pb-4">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" id="inputEmail4" value="{{$trainer->email}}" name="email" readonly>
        </div>

        <div class="col-md-5 pb-4">
          <label for="inputAddress" class="form-label">Address</label>
          <input type="text" class="form-control" id="inputAddress" value="{{$trainer->address}}" name="address" readonly>
        </div>
       
        <div class="col-md-5 pb-4">
          <label for="inputPassword4" class="form-label">Card ID</label>
          <input type="number" class="form-control" id="inputPassword4"  value="{{$trainer->card_id}}" name="card_id" readonly> 
        </div>

        <div class="col-md-5 pb-4">
          <label for="inputEmail4" class="form-label">Phone Number</label>
          <input type="phone" class="form-control" id="inputEmail4" value="{{$trainer->phone}}" name="phone" readonly>
        </div>

        <div class="col-md-5 pb-4">
          <label for="inputAddress" class="form-label">Working Hours</label>
          <input type="text" class="form-control" id="inputAddress" value="{{$trainer->working_hours}}" name="working_hours" readonly>
        </div>

        <div class="col-md-5 pb-4">
          <label for="inputAddress" class="form-label">Class</label>
          <input type="text" class="form-control" id="inputAddress" value="{{$trainer->class}}" name="class" readonly>
        </div>
       
        <div class="col-md-5 pb-4">
          <label for="inputAddress" class="form-label">Salary</label>
          <input type="number" class="form-control" id="inputAddress" value="{{$trainer->salary}}" name="salary" readonly>
        </div>

        <div class="col-md-5">
          <button type="submit" class="btn btn-lg btn-secondary mt-5" data-toggle="modal" data-target="#editModal{{$trainer->id}}">Edit</button>
        </div>
        <div class="col-md-5">
          <button type="submit" class="btn btn-lg btn-success mt-5" data-toggle="modal" data-target="#addModal{{$trainer->id}}"><i class="fa fa-user-plus"></i>  Assign Member</button>
        </div>
      </div>

       <!--EDIT MODAL-->
        <div class="modal fade" id="editModal{{$trainer->id}}">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Update</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <form method="POST" action="{{ route('trainers.update') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-body">
                          <div class="row">
                              <input type="text" name="id" value="{{$trainer->id}}" hidden="true">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Name</label>
                                      <input type="text" class="form-control @error('name') is-invalid @enderror " name="name" value="{{$trainer->name}}">
                                      @error('name')
                                      <div class="alert alert-danger">{{$message}}</div>
                                      @enderror
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Email</label>
                                      <input type="text" class="form-control @error('email') is-invalid @enderror " name="email" value="{{$trainer->email}}">
                                      @error('email')
                                  <div class="alert alert-danger">{{$message}}</div>
                                  @enderror
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-group">
                                  <label>Phone Number</label>
                              
                                  <input type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$trainer->phone}}">
                                  @error('phone')
                                  <div class="alert alert-danger">{{$message}}</div>
                                  @enderror
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-group">
                                  <label>Address</label>                            
                                  <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$trainer->address}}">
                                  @error('address')
                                  <div class="alert alert-danger">{{$message}}</div>
                                  @enderror
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Salary</label>
                                      <input type="number" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{$trainer->salary}}">
                                      @error('salary')
                                      <div class="alert alert-danger">{{$message}}</div>
                                      @enderror
                                  </div>
                              </div>

                              
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Class</label>
                                      <input type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{$trainer->class}}">
                                      @error('class')
                                      <div class="alert alert-danger">{{$message}}</div>
                                      @enderror
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Working Hours</label>
                                      <input type="text" class="form-control @error('working_hours') is-invalid @enderror" name="working_hours" value="{{$trainer->working_hours}}">
                                      @error('working_hours')
                                      <div class="alert alert-danger">{{$message}}</div>
                                      @enderror
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Card ID</label>
                                      <input type="number" class="form-control @error('card_id') is-invalid @enderror " name="card_id" value="{{$trainer->card_id}}">
                                      @error('card_id')
                                      <div class="alert alert-danger">{{$message}}</div>
                                      @enderror
                                  </div>
                              </div>

                          </div>
                      </div>

                      <div class="modal-footer justify-content-between">
                          <button class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Save</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
       <!--END OF EDIT MODAL-->

       <!--Assign MODAL-->
         <div class="modal fade" id="addModal{{$trainer->id}}">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Assignments</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <form method="POST" action="{{ route('trainers.member.add') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-body">
                          <div class="row">
                              <input type="text" name="id" value="{{$trainer->id}}" hidden="true">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="assign-member" class="form-label">Members</label>
                                      <select class="form-control" aria-label="members" name='member' required>
                                          <option selected>All</option>
                                          @foreach($all as $member)
                                            <option value="{{$member->id}}">{{$member->name}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="modal-footer justify-content-between">
                          <button class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Assign</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
       <!--END OF Assign MODAL-->
    </div>

  </div>
</div>

<br>

<div class="mt-2 card-profile">
  <div class="collapse" id="memberstable">
    <div class="card card-body">
      <h2 class="text-warning"> Assigned Members </h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>card No</th>
            <th>Period</th>
            <th>Sessions</th>
            <th>phone</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($members as $member)
          <tr>
            <td>{{$member->name}}</td>
            <td>{{$member->barcode_number}}</td>
            <td>{{$member->membership_period}}</td>
            <td>{{$member->sessionsNumber}}</td>
            <td>{{$member->phone}}</td>
            <td>
              <a class="btn btn-primary"  href="{{route('profile',$member->id)}}"><i class="fa fa-eye"></i> Show</a>
              <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$member->id}}">Delete Assignment</button>
            </td>
          </tr>
           <!--DELETE MODAL-->
           <div class="modal fade" id="deleteModal{{$member->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Assignment of {{$member->name}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="POST" action="{{route('trainers.member.delete') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                            <input type="text" name="id" value="{{$member->id}}" hidden>
                                <div class="col-md-12">
                                    <p>Are you sure you want to delete this?</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Delete</button>
                        </div>

                    </form>
                </div>
            </div>
           </div>
           <!--END OF DELETE MODAL-->
        @endforeach
        </tbody>
      </table>
      {!! $members->links() !!}
    </div>
  </div>
</div>



<div class="collapse" id="attendance">
  <div class="card-details p-3 ">
    <h2 class="text-warning">Attendance</h2>
    <table class="table table-hover table-bordered">
      <thead>
      <tr>
          <th scope="col">Date</th>
          <th scope="col">Time</th>
      </tr>
      </thead>

      <tbody>
      @foreach($attendances as $attendance)
          <tr>
              <td>
                  {{$attendance->created_at->toDateString()}}
              </td>
              <td>
                  {{$attendance->created_at->format('g:i A')}}
              </td>
          </tr>
      @endforeach
      </tbody>
  </table>
  {!! $attendances->links() !!}
  </div>
</div>




<style type="text/css">
  .card-profile{
    /* background-color: white; */
    border-radius: 10px;
   

  }

  .card-details{
    background-color: white;
    border-radius: 10px;
  }

  
</style>

@endsection