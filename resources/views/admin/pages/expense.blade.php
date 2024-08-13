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
                    <div class="row">
                        <div class="col-md-12">
                            <p class="float-end">Total Cost : &#2547;{{number_format($total_cost)}}</p>
                        </div>
                    </div>
                    <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Purpose</th>
                            <th>Amount</th>
                            <th>Added By</th>
                            <th>Update By</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $expense)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{\Illuminate\Support\Str::limit($expense->purpose, 20)}}</td>
                                <td>
                                    {{number_format($expense->amount)}} TK
                                </td>
                                <td>
                                    {{$expense->userAdd->name ?? 'N/A'}}
                                </td>
                                <td>
                                    {{$expense->userUpdate->name ?? 'N/A'}}
                                </td>
                                <td>{{ $expense->created_at->format('d-m-Y H:i A') }}</td>
                                <td>
                                    <button type="button" value="{{$expense->id}}" class="btn btn-success editBtn btn-sm" title="Edit">
                                        <i class="ri-edit-box-fill"></i>
                                    </button>
                                    @if(Auth::user()->id == 1)
                                    <button type="button" onclick="confirmDelete({{$expense->id}});" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="ri-chat-delete-fill"></i>
                                    </button>
                                    @endif

                                    <form action="{{route('expense.delete', ['id' => $expense->id])}}" method="POST" id="expenseDeleteForm{{$expense->id}}">
                                        @csrf
                                    </form>
                                    <script>
                                        function confirmDelete(expenseId) {
                                            var confirmDelete = confirm('Are you sure you want to delete this?');
                                            if (confirmDelete) {
                                                document.getElementById('expenseDeleteForm' + expenseId).submit();
                                            } else {
                                                return false;
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>
                        @endforeach
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
                    <form action="{{route('expense.new')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Purpose:</label>
                            <textarea class="form-control" name="purpose" id="message-text" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Amount:</label>
                            <input type="number" class="form-control" name="amount" id="recipient-name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> <!-- end modal footer -->
                    </form>
                </div>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->

    <!-- Add Modal -->
    <div class="modal fade" id="editExpenseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Expanse Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form action="{{route('expense.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="expense_id" id="vExpense_id">
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Purpose:</label>
                            <textarea class="form-control" name="purpose" id="purpose" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Amount:</label>
                            <input type="number" class="form-control" name="amount" id="amount" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> <!-- end modal footer -->
                    </form>
                </div>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->

    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.editBtn', function () {
                var expense_id = $(this).val();
                var editExpenseRoute = "{{ route('expense.edit', ':id') }}";
                $('#editExpenseModal').modal('show');

                // Replace the placeholder ':id' with the actual notification ID
                var url = editExpenseRoute.replace(':id', expense_id);

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (response) {
                        console.log(response);

                        $('#purpose').val(response.expense.purpose);
                        $('#amount').val(response.expense.amount);

                        $('#vExpense_id').val(expense_id);
                    }
                });
            });
        });
    </script>

@endsection



