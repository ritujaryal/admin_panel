@extends('admin.main-layout')

@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Company</li>
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
              <h3 class="card-title">Company</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <form action="{{ route('companies.update', $company->id) }}" method="post" enctype="multipart/form-data">
          	@csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="inputName"> Name</label>
                <input type="text" name="name" id="inputName" class="form-control" value="{{ old('name', $company->name) }}">
              </div>
              @error('name')
                 <div class="text-danger">{{$message}}</div>
              @enderror
              <div class="form-group">
                <label for="inputDescription">Email</label>
                <textarea name="email" id="inputDescription" class="form-control" rows="4" >{{ old('email', $company->email) }}</textarea>
              </div>
              @error('email')
                 <div class="text-danger">{{$message}}</div>
              @enderror
              <div class="form-group">
                <label for="inputClientCompany">Logo</label>
                <div class="custom-file">
                        <input name="image" type="file" class="custom-file-input" id="exampleInputFile" value="{{ old('image', $company->logo) }}">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
          

              </div>
              @error('image')
                 <div class="text-danger">{{$message}}</div>
              @enderror
              <div class="form-group">
                <label for="inputProjectLeader">Website</label>
                <input name="website" type="text" id="inputProjectLeader" class="form-control" value="{{ old('website', $company->website) }}">
                
              </div>
            </div>
            <!-- /.card-body -->
			<div class="row">
				<div class="col-12">
					<button type="submit" class="btn btn-success float-right">Update Company</button>
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