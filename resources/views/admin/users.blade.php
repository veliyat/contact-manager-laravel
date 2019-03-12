@extends('admin.layouts.app')

@section('content')
    <!-- DataTables Example -->
    <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Example</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th> 
                        <th>Status</th>                   
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>  
                        <th>Status</th>                  
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->type }}</td>
                            <td>
                              @if($user->active)
                              <span class="badge badge-primary">Active</span>
                              @else
                              <span class="badge badge-secondary">Inactive</span>
                              @endif
                            </td>
                            <td>
                                @if($user->active)
                                  <a href="{{ url('admin/users/deactivate/'.$user->id) }}" class="btn btn-danger btn-sm">Deactivate</a>
                                @else
                                  <a href="{{ url('admin/users/activate/'.$user->id) }}" class="btn btn-success btn-sm">Activate</a>
                                @endif
                            </td>
                        </tr>       
                    @endforeach           
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

@stop