@extends('pharmacy.layouts.app')

@section('content')
<style>
    .main-image {
    border: 1px solid #000;
    margin-bottom: 20px;
    height: 300px; /* Adjust as needed */
  }
  .image-gallery {
    display: flex;
    justify-content: space-between;
  }
  .image-gallery div {
    border: 1px solid #000;
    width: calc(25% - 10px); /* Adjust spacing based on number of images */
  }
</style>
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="{{ asset('assets/img/user.jpg') }}" class="w--26" alt="">
            </span>
            <span>
                {{ translate('messages.make_quotation') }}
            </span>
        </h1>
    </div>
    <!-- End Page Header -->
    <div class="card p-4">
        <div class="row">
            <div class="col-md-6">
                <div class="main-image">
                    <img src="{{ asset(getPrescriptionImagePath(json_decode($lims_prescription_data->images)[0])) }}" alt="Image 1" style="object-fit: cover;width:100%;height:300px">
                </div>
                <div class="image-gallery">
                    @foreach (json_decode($lims_prescription_data->images) as $key => $image)
                        @if ($key != 0)
                        <div>
                            <img src="{{ asset(getPrescriptionImagePath($image)) }}" alt="Image 1" style="object-fit: cover;width:100%;height:150px">
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <form action="{{ route('pharmacy.quotation.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="prescription_id" value="{{ $lims_prescription_data->id }}">
                    <div class="table-responsive">
                        <table class="table table-striped quotation-list">
                            <thead>
                                <tr>
                                    <th>Drug</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="quotation-body">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <th id="total-cost">0.00</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="form-group row mb-3">
                            <label for="drug" class="col-sm-5 col-form-label">{{ translate('messages.drug') }}</label>
                            <div class="col-sm-7">
                              <input type="text" name="drug" class="form-control" id="drug">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="unit_price" class="col-sm-5 col-form-label">{{ translate('messages.unit_cost') }}</label>
                            <div class="col-sm-7">
                              <input type="number" name="unit_price" class="form-control" id="unit_price">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="quantity" class="col-sm-5 col-form-label">{{ translate('messages.quantity') }}</label>
                            <div class="col-sm-7">
                              <input type="number" name="quantity" class="form-control" id="quantity">
                            </div>
                        </div>
                        <input type="hidden" name="total_cost" id="total_cost" value="">
                        <div class="col-md-12">
                            <button class="btn btn-primary float-end w-25" onclick="addDrugData()" type="button">{{ translate('messages.add') }}</button>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <button class="btn btn-primary float-end w-50" type="submit">{{ translate('messages.send_quotation') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        let totalCost = 0;
        function addDrugData() {
            const drug = $('#drug').val();
            const unitPrice = $('#unit_price').val();
            const quantity = $('#quantity').val();
            
            if (drug && unitPrice && quantity) {
                const total = unitPrice * quantity;
                totalCost += total;

                var newRow = $("<tr>");
                var cols = '';
                cols += '<td>' + drug + '</td>';
                cols += '<td>' + unitPrice + ' x '+ quantity +'</td>';
                cols += '<td>' + total.toFixed(2) + '</td>';
                cols += '<input type="hidden" class="drug" name="drug_name[]" value="'+drug+'"/>';
                cols += '<input type="hidden" class="net_unit_cost" name="net_unit_cost[]"  value="'+unitPrice+'"/>';
                cols += '<input type="hidden" class="qty" name="qty[]"  value="'+quantity+'"/>';
                cols += '<input type="hidden" class="subtotal" name="total[]"  value="'+total+'"/>';
                newRow.append(cols);
                $("table.quotation-list tbody").prepend(newRow);

                $('#drug').val('');
                $('#unit_price').val('');
                $('#quantity').val('');

                updateTotalCost();
            } else {
                alert('Please fill in all fields.');
            }
        }

        function updateTotalCost() {
            document.getElementById('total-cost').textContent = totalCost.toFixed(2);
            document.getElementById('total_cost').value = totalCost.toFixed(2);
        }
    </script>
@endpush