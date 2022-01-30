@extends('admin.main-layout')

@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Companies</li>
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
            <a href="{{route('companies.create')}}" class="btn btn-success">Create new Company</a>
        </div>
        </div>
        <div class="row"> <div class="col-12"> &nbsp;&nbsp;</div></div>

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Companies List</h3>

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
          <table  class="table table-striped projects table_pagination">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                         Name
                      </th>
                      <th style="width: 8%">
                          Email
                      </th>
                      <th style="width: 30%">
                          Logo
                      </th>
                      <th style="width: 8%" class="text-center">
                          Website
                      </th>
                      <th style="width: 10%">
                      </th>
                      <th style="width: 10%">
                      </th>
                  </tr>
              </thead>
              <tbody>
              @foreach ($company as $companies)
                  <tr>
                      <td>
                          #
                      </td>
                      <td>
                          <a>
                          {{ $companies->name }}
                          </a>
                          
                      </td>
                      <td>
                          <ul class="list-inline">
                              <li class="list-inline-item">
                              {{ $companies->email }}
                              </li>
                           
                          </ul>
                      </td>
                      <td class="project_progress">
                          <img class="img-responsive img-rounded" src="{{ asset('storage/logo_images/'. $companies->logo.'') }}" style= "height: 100px; width: 100px;" alt="">
                      
                      </td>
                      <td class="project-state">
                          <span class="badge badge-success"> {{ $companies->website }}</span>
                      </td>
                      <td class="project-actions text-right">
                         
                          <a class="btn btn-info btn-sm" href="{{ route('companies.edit', $companies->id) }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          </td>
                          <td class="project-actions text-left">
                        
                          <form action="{{ route('companies.destroy', $companies->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger btn-sm">
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
