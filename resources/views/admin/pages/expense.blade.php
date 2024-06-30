@extends('admin.master')
@section('title')
    Expense manage | {{env('APP_NAME')}}
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right" style="display: block!important;">
                    <button href="javascript: void(0);" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="mdi mdi-plus"></i>
                        Add Expense
                    </button>
                </div>
                <h4 class="page-title">Expense Manage</h4>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Purpose</th>
                            <th>Amount</th>
                            <th>Added By</th>
                            <th>Update By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @foreach($categories as $category)--}}
{{--                            <tr>--}}
{{--                                <td>{{$loop->iteration}}</td>--}}
{{--                                <td>{{$category->category_name}}</td>--}}
{{--                                <td>--}}
{{--                                    @if($category->parent_id == 0)--}}
{{--                                        Main Category--}}
{{--                                    @else--}}
{{--                                        {{$category->subCategory->category_name}}--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @if($category->status == 1)--}}
{{--                                        <span class="badge bg-success">Active</span>--}}
{{--                                    @else--}}
{{--                                        <span class="badge bg-danger">In Active</span>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{route('category.edit', ['id' => $category->id])}}" class="btn btn-success btn-sm" title="Edit">--}}
{{--                                        <i class="ri-edit-box-fill"></i>--}}
{{--                                    </a>--}}
{{--                                    <button type="button" onclick="confirmDelete({{$category->id}});" class="btn btn-danger btn-sm" title="Delete">--}}
{{--                                        <i class="ri-chat-delete-fill"></i>--}}
{{--                                    </button>--}}

{{--                                    <form action="{{route('category.delete', ['id' => $category->id])}}" method="POST" id="categoryDeleteForm{{$category->id}}">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                    <script>--}}
{{--                                        function confirmDelete(categoryId) {--}}
{{--                                            var confirmDelete = confirm('Are you sure you want to delete this?');--}}
{{--                                            if (confirmDelete) {--}}
{{--                                                document.getElementById('categoryDeleteForm' + categoryId).submit();--}}
{{--                                            } else {--}}
{{--                                                return false;--}}
{{--                                            }--}}
{{--                                        }--}}
{{--                                    </script>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Expanse Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Purpose:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Amount:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div> <!-- end modal footer -->
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->

@endsection



