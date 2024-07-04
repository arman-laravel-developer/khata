@extends('admin.master')
@section('title')
    Dollar Sell manage | {{env('APP_NAME')}}
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right" style="display: block!important;">
                    <button href="javascript: void(0);" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="mdi mdi-plus"></i>
                        Add Dollar Sell
                    </button>
                </div>
                <h4 class="page-title">Dollar Sell Manage</h4>
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
                            <th>Member ID</th>
                            <th>Dollar QTY</th>
                            <th>Dollar Rate</th>
                            <th>BDT</th>
                            <th>Due Amount</th>
                            <th>Add By</th>
                            <th>Update By</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sells as $sell)
                            @php
                                $total_pay = \App\Models\Detail::where('payment_received_id', $sell->id)->sum('amount');
                            @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$sell->member_id}}</td>
                                <td>${{$sell->dollar}}</td>
                                <td>{{$sell->rate}}</td>
                                <td>{{number_format($sell->amount + $total_pay)}}TK</td>
                                <td>{{number_format($sell->amount)}}TK</td>
                                <td>{{$sell->userAdd->name}}</td>
                                <td>{{$sell->userUpdate->name ?? 'N/A'}}</td>
                                <td>
                                    @if($sell->payment_status == 1)
                                        <span class="badge bg-success">Complete</span>
                                    @else
                                        <span class="badge bg-danger">Due</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" value="{{$sell->id}}" class="btn btn-success editBtn btn-sm" title="Edit">
                                        <i class="ri-edit-box-fill"></i>
                                    </button>
                                    <button type="button" onclick="confirmDelete({{$sell->id}});" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="ri-chat-delete-fill"></i>
                                    </button>

                                    <form action="{{route('payment-received.delete', ['id' => $sell->id])}}" method="POST" id="sellDeleteForm{{$sell->id}}">
                                        @csrf
                                    </form>
                                    <script>
                                        function confirmDelete(sellId) {
                                            var confirmDelete = confirm('Are you sure you want to delete this?');
                                            if (confirmDelete) {
                                                document.getElementById('sellDeleteForm' + sellId).submit();
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
        <div class="modal-dialog  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Dollar Sell Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form action="{{route('payment-received.new')}}" id="submitForm" method="POST" enctype="multipart/form-data">
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
                            <label class="col-form-label">Paying Amount:</label>
                            <input type="text" class="form-control" name="paying_amount" id="paying_amount" required>
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
    <div class="modal fade" id="editSellModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Dollar Sell Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form action="{{route('payment-received.new')}}" id="submitForm" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="sell_id" id="sell_id">
                        <div class="mb-3">
                            <label class="col-form-label">Member ID:</label>
                            <input type="number" class="form-control" name="member_id_edit" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Amount:</label>
                            <input type="text" class="form-control" name="amount" id="amount_edit" readonly required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Paying Amount:</label>
                            <input type="text" class="form-control" name="paying_amount" id="paying_amount" required>
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
                var sell_id = $(this).val();
                var editSellRoute = "{{route('payment-received.edit', ':id')}}"
                $('#editSellModal').modal('show');

                var url = editSellRoute.replace(':id', sell_id);

                $.ajax({
                    type : 'GET',
                    url : url,
                    success : function (response) {
                        console.log(response);

                        $('#member_id_edit').val(response.sell.member_id)
                        $('#amount_edit').val(response.sell.amount)

                        $('#sell_id').val(sell_id);
                    }
                });
            });
        });
    </script>



@endsection



