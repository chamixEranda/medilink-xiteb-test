@extends('user.layouts.app')

@section('content')

<section  class="about_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        {{ translate('messages.My_Quotations') }}
      </h2>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-stripe">
            <thead>
              <tr>
                  <th class="border-0">{{ translate('messages.quotation_no') }}</th>
                  <th class="border-0">{{ translate('messages.user') }}</th>
                  <th class="border-0">{{translate('messages.details')}}</th>
                  <th class="border-0">{{translate('messages.total_cost')}}</th>
                  <th class="border-0">{{translate('messages.status')}}</th>
                  <th class="border-0">{{translate('messages.action')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($lims_quotation_list as $key=> $quotation)
                <tr>
                    <td>{{ $quotation->id }}</td>
                    <td>{{ $quotation->user->name }}</td>
                    <td>
                        @foreach ($quotation->details as $item)
                            {!! $item->drug_name .' - '. number_format($item->net_unit_cost,2) .' x '. $item->qty .'</br>' !!}
                        @endforeach
                    </td>
                    <td>{{ number_format($quotation->total_cost,2) }}</td>
                    <td>
                      @if ($quotation->status == 'pending')
                        <span class="badge badge-warning text-capitalize">
                          {{ translate('messages.pending') }}
                        </span>
                      @elseif($quotation->status == 'confirm')
                        <span class="badge badge-info text-capitalize">
                          {{ translate('messages.confirmed') }}
                        </span>
                      @else
                        <span class="badge badge-danger text-capitalize">
                          {{ translate('messages.rejected') }}
                        </span>
                      @endif
                    </td>
                    <td>
                      @if ($quotation->status == 'pending')
                      <a class="btn action-btn btn--success btn-outline-success"
                        href="javascript:" onclick="route_alert('{{ route('quotation.status', ['id' => $quotation['id'], 'status' => 'confirm']) }}','{{ translate('Change status to confirm ?') }}')"
                        title="{{ translate('messages.confirm') }}">{{ translate('messages.confirm') }}
                      </a>
                      <a class="btn action-btn btn--danger btn-outline-danger"
                        href="javascript:" onclick="route_alert('{{ route('quotation.status', ['id' => $quotation['id'], 'status' => 'reject']) }}','{{ translate('Change status to reject ?') }}')"
                        title="{{ translate('messages.reject') }}">{{ translate('messages.reject') }}
                      </a>
                      @endif
                      
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection