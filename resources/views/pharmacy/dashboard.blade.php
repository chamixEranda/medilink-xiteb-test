@extends('pharmacy.layouts.app')

@section('content')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Total Users</h6>
                <div class="d-flex align-items-center justify-content-between">
                  <h6 class="fw-semibold fs-4 mb-0">{{ $lims_user_count }}</h6>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Total Prescriptions</h6>
                <div class="d-flex align-items-center justify-content-between">
                  <h6 class="fw-semibold fs-4 mb-0">{{ $lims_prescription_count }}</h6>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Accepted Quotations</h6>
                <div class="d-flex align-items-center justify-content-between">
                  <h6 class="fw-semibold fs-4 mb-0">{{ $lims_confirm_count }}</h6>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Rejected Quotations</h6>
                <div class="d-flex align-items-center justify-content-between">
                  <h6 class="fw-semibold fs-4 mb-0">{{ $lims_reject_count }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Recent Transactions</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">{{ translate('messages.quotation_no') }}</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">{{ translate('messages.user') }}</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">{{translate('messages.details')}}</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">{{translate('messages.total_cost')}}</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">{{translate('messages.status')}}</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($latest_quotations as $key=> $quotation)
                      <tr>
                          <td>{{ $quotation->id }}</td>
                          <td>{{ $quotation->user->name }}</td>
                          <td>
                              @foreach ($quotation->details as $item)
                                  {!! $item->drug_name .' - '. $item->net_unit_cost .' x '. $item->qty .'</br>' !!}
                              @endforeach
                          </td>
                          <td>{{ number_format($quotation->total_cost,2) }}</td>
                          <td>{{ $quotation->status }}</td>
                      </tr>
                      @endforeach     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
@endsection