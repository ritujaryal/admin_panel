@extends('admin.main-layout')

@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Employee</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @endsection
    @section('body')
    <!-- Main content -->
    <section class="content">
      <div class="row">
      @if(session('error'))
    	<div class="text-danger text-center">{{session('error')}}</div>
    	@endif
      @if(session('success'))
      <div class="text-success text-center">{{session('success')}}</div>
      @endif
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Employee</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <form action="{{ route('employees.update', $employee->id) }}" method="post">
          	@csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">First Name</label>
                <input name="first_name" type="text" id="inputName" class="form-control" value="{{ old('first_name', $employee->first_name) }}">
              </div>
              @error('first_name')
                 <div class="text-danger">{{$message}}</div>
              @enderror
              <div class="form-group">
                <label for="inputDescription">Last Name</label>
                <input name="last_name" type="text" id="inputNamelast" class="form-control" value="{{ old('last_name', $employee->last_name) }}">
              </div>
              @error('last_name')
                 <div class="text-danger">{{$message}}</div>
              @enderror
            
              <div class="form-group">
                  <label for="exampleSelectBorder">Company <code></code></label>
                  <select class="custom-select form-control-border" name="company_id" id="exampleSelectBorder">
                  @foreach ($company_list as $companies)
                    <option  value="{{ $companies->id }}" {{ ( $companies->id == $employee->company_id) ? 'selected' : '' }} >{{$companies->name}}</option>
                    @endforeach
                  </select>
                </div>
              <div class="form-group">
                <label for="inputProjectLeader">Email</label>
                <input type="text" id="inputProjectLeader" class="form-control" name="email" value="{{ old('email', $employee->email) }}">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Phone</label>
                <input type="text" id="inputProjectLeader" class="form-control" name="phone" value="{{ old('phone', $employee->phone) }}">
              </div>
              @error('phone')
                 <div class="text-danger">{{$message}}</div>
              @enderror
            </div>
            <!-- /.card-body -->
            <div class="row">
          <div class="col-12">        
          <input type="submit" value="Update Employee" class="btn btn-success float-right">
        </div>
      </div>
    </form>
          </div>
          <!-- /.card -->
        </div>
       
      </div>
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection