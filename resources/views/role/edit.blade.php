@extends('admin.master')

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-light" id="dash-daterange">
                            <span class="input-group-text bg-primary border-primary text-white">
                                                    <i class="mdi mdi-calendar-range font-13"></i>
                                                </span>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-primary ms-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        <a href="javascript: void(0);" class="btn btn-primary ms-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Edit Role form</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14">{{Session::get('message')}}</p>
                    <form class="form-horizontal" action="{{route('role.update', ['id' => $role->id])}}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-2 col-form-label">Role Name</label>
                            <div class="col-10">
                                <input type="text" class="form-control" value="{{$role->name}}" name="name" id="inputEmail3" placeholder="Role Name"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-2 col-form-label">Description</label>
                            <div class="col-10">
                                <textarea class="form-control" id="inputPassword3" name="description" placeholder="Role Description">{{$role->description}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-end">
                            <label class="col-2 col-form-label">Select Route</label>
                            <div class="col-10">
                                <table class="table table-bordered text-center table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <th>
                                        Name
                                    <td>Add Form</td>
                                    <td>Create</td>
                                    <td>Manage</td>
                                    <td>Edit Form</td>
                                    <td>Update</td>
                                    <td>Delete</td>
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach ($routeLists as $prefix => $routeNames)
                                        <tr>
                                            <td>{{ $prefix }}</td> <!-- Prefix column -->
                                            @foreach ($routeNames as $key => $routeName)
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <input type="checkbox" value="{{ $routeName }}" style="height: 20px;width: 20px;" name="route_name[]" @foreach($role->roleRoutes as $roleRoute) {{ $routeName == $roleRoute->route_name ? 'checked' : '' }} @endforeach class="form-check-input" id="customCheck{{ $key }}"/>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-10">
                                <button type="submit" class="btn btn-info">Update Role Info</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>
@endsection
