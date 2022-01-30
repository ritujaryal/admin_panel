@extends('admin.main-layout')

@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employees</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @endsection
    @section('body')
    <!-- Main content -->
    <section class="content">
    @if(session('error'))
    	<div class="text-danger text-center alertmsg">{{session('error')}}</div>
    	@endif
      @if(session('success'))
      <div class="text-success text-center alertmsg">{{session('success')}}</div>
      @endif
        <div class="row">
            <div class="col-12">
            <a href="{{route('employees.create')}}" class="btn btn-success">Create new Employee</a>
        </div>
        </div>
        <div> &nbsp;&nbsp;&nbsp;</div>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Employee List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects table_pagination">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                         Name
                      </th>
                      <th style="width: 30%">
                          Company
                      </th>
                      <th>
                          Email
                      </th>
                      <th style="width: 8%" class="text-center">
                          Phone
                      </th>
                      <th style="width: 10%">
                      </th>
                      <th style="width: 10%">
                      </th>
                  </tr>
              </thead>
              <tbody>
              @foreach ($employees as $employees_info)
                  <tr>
                      <td>
                          #
                      </td>
                      <td>
                          <a>
                          {{ $employees_info->first_name }}   {{ $employees_info->last_name }}
                          </a>
                       
                      </td>
                      <td>
                          <ul class="list-inline">
                              <li class="list-inline-item">
                              <?php
                                 $company_id =  DB::table('companies')->where("id",$employees_info->company_id)->first()->name;
                              ?>
                              {{ $company_id }} 
                              </li>
                           
                          </ul>
                      </td>
                      <td class="project_progress">                        
                          {{ $employees_info->email }}      
                      </td>
                      <td class="project-state">
                          {{ $employees_info->phone }} 
                      </td>
                      <td class="project-actions text-right">
                         
                          <a class="btn btn-info btn-sm" href="{{ route('employees.edit', $employees_info->id) }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                        </td>
                          <td class="project-actions text-left"> 
                          <form action="{{ route('employees.destroy', $employees_info->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger btn-sm" >
                              <i class="fas fa-trash"></i>Delete
                          </button>
                        </form>
                      </td>
                      </td>
                  </tr>
               @endforeach
              
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  @endsection
