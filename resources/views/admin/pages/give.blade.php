@extends('admin.master')
@section('title')
    Dollar Buy manage | {{env('APP_NAME')}}
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right" style="display: block!important;">
                    <button href="javascript: void(0);" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="mdi mdi-plus"></i>
                        Add Dollar Buy
                    </button>
                </div>
                <h4 class="page-title">Dollar Buy Manage</h4>
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
                            <p class="float-end">Total Dollar : ${{number_format($dollar)}}</p>
                            <p>Total BDT : &#2547;{{number_format($bdt)}}</p>
                        </div>
                    </div>
                    <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Member ID</th>
                            <th>Dollar QTY</th>
                            <th>Dollar Rate</th>
                            <th>BDT</th>
                            <th>Payment Gateway</th>
                            <th>Add By</th>
                            <th>Update By</th>
                            <th>Payment Date</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gives as $give)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$give->member_id}}</td>
                                <td>${{$give->dollar}}</td>
                                <td>{{$give->rate}} TK/$</td>
                                <td>{{number_format($give->amount)}} TK</td>
                                <td>{{$give->payment_gateway}}</td>
                                <td>{{$give->userAdd->name}}</td>
                                <td>{{$give->userUpdate->name ?? 'N/A'}}</td>
                                <td>{{ $give->created_at->format('d-m-Y H:i A') }}</td>
                                <td>
                                    @if($give->payment_status == 1)
                                        <span class="badge bg-success">Complete</span>
                                    @else
                                        <span class="badge bg-danger">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" value="{{$give->id}}" class="btn btn-success editBtn btn-sm" title="Edit">
                                        <i class="ri-edit-box-fill"></i>
                                    </button>
                                    @if(Auth::user()->id == 1)
                                    <button type="button" onclick="confirmDelete({{$give->id}});" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="ri-chat-delete-fill"></i>
                                    </button>
                                    @endif

                                    <form action="{{route('payment-give.delete', ['id' => $give->id])}}" method="POST" id="giveDeleteForm{{$give->id}}">
                                        @csrf
                                    </form>
                                    <script>
                                        function confirmDelete(giveId) {
                                            var confirmDelete = confirm('Are you sure you want to delete this?');
                                            if (confirmDelete) {
                                                document.getElementById('giveDeleteForm' + giveId).submit();
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
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Dollar Buy Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form action="{{route('payment-give.new')}}" id="submitForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="col-form-label">Member ID:</label>
                            <input type="number" class="form-control" name="member_id" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Dollar QTY:</label>
                            <input type="number" class="form-control" name="dollar" id="dollar_qty" oninput="calculateAmount()" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Dollar Rate:</label>
                            <input type="number" class="form-control" name="rate" id="dollar_rate" oninput="calculateAmount()" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Amount:</label>
                            <input type="text" class="form-control" name="amount" id="amount" readonly required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Payment gateway:</label>
                            <input type="text" class="form-control" name="payment_gateway" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" onclick="validateAndSubmitForm()" class="btn btn-primary">Submit</button>
                </div> <!-- end modal footer -->
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->

    <!-- Edit Modal -->
    <div class="modal fade" id="editGiveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Payment Give Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form action="{{route('payment-give.update')}}" id="submitFormEdit" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="give_id" id="give_id">
                        <div class="mb-3">
                            <label class="col-form-label">Member ID:</label>
                            <input type="number" class="form-control" name="member_id" id="member_id" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Dollar QTY:</label>
                            <input type="number" class="form-control" name="dollar" id="dollar_qty_edit" oninput="calculateAmountEdit()" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Dollar Rate:</label>
                            <input type="number" class="form-control" name="rate" id="dollar_rate_edit" oninput="calculateAmountEdit()" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Amount:</label>
                            <input type="text" class="form-control" name="amount" id="amount_edit" readonly required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Payment gateway:</label>
                            <input type="text" class="form-control" name="payment_gateway" id="payment_gateway_edit"  required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" onclick="validateAndSubmitEditForm()" class="btn btn-primary">Submit</button>
                </div> <!-- end modal footer -->
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->

    <script>
        function calculateAmount() {
            const dollarQty = document.getElementById('dollar_qty').value;
            const dollarRate = document.getElementById('dollar_rate').value;
            const amount = dollarQty * dollarRate;
            document.getElementById('amount').value = amount ? amount : '';
        }

        function calculateAmountEdit() {
            const dollarQtyEdit = document.getElementById('dollar_qty_edit').value;
            const dollarRateEdit = document.getElementById('dollar_rate_edit').value;
            const amountEdit = dollarQtyEdit * dollarRateEdit;
            document.getElementById('amount_edit').value = amountEdit ? amountEdit : '';
        }
        function validateAndSubmitForm() {
            const form = document.getElementById('submitForm');
            if (form.checkValidity()) {
                form.submit();
            } else {
                alert('Please fill out all required fields.');
            }
        }
        function validateAndSubmitEditForm() {
            const form = document.getElementById('submitFormEdit');
            if (form.checkValidity()) {
                form.submit();
            } else {
                alert('Please fill out all required fields.');
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.editBtn', function () {
                var give_id = $(this).val();
                var editGiveRoute = "{{route('payment-give.edit', ':id')}}";
                $('#editGiveModal').modal('show');

                var url = editGiveRoute.replace(':id', give_id);

                $.ajax({
                    type : 'GET',
                    url : url,
                    success : function (response) {
                        console.log(response);

                        $('#member_id').val(response.give.member_id);
                        $('#dollar_qty_edit').val(response.give.dollar);
                        $('#dollar_rate_edit').val(response.give.rate);
                        $('#amount_edit').val(response.give.amount);
                        $('#payment_gateway_edit').val(response.give.payment_gateway);

                        $('#give_id').val(give_id);
                    }
                });
            });
        });
    </script>


@endsection



