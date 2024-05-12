@extends('pharmacy.layouts.app')

@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-header-title">
            <span>
                {{ translate('messages.quotations') }}
            </span>
        </h1>
    </div>
    <!-- End Page Header -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h5 class="card-title fw-semibold mb-4">{{ translate('messages.quotation_list') }}</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="prescription-table" class="table">
                <thead>
                    <tr>
                        <th class="not-exported"></th>
                        <th class="border-0">{{ translate('messages.quotation_no') }}</th>
                        <th class="border-0">{{ translate('messages.prescription') }}</th>
                        <th class="border-0">{{ translate('messages.user') }}</th>
                        <th class="border-0">{{translate('messages.details')}}</th>
                        <th class="border-0">{{translate('messages.total_cost')}}</th>
                        <th class="border-0">{{translate('messages.status')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lims_quotation_list as $key=> $quotation)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $quotation->id }}</td>
                        <td>{{ $quotation->prescription->id }}</td>
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

<div class="modal fade" id="prescriptionModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="prescription-content">
                
            </div>
        </div>
    </div>

@endsection
@push('script')
<script>
    var table = $('#prescription-table').DataTable( {
    "order": [],
    'language': {
        'lengthMenu': '_MENU_ {{translate("messages.records per page")}}',
            "info":      '<small>{{translate("messages.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
        "search":  '{{translate("messages.Search")}}',
        'paginate': {
                'previous': '<i class="fas fa-chevron-left"></i>',
                'next': '<i class="fas fa-chevron-right"></i>'
        }
    },
    'columnDefs': [
        {
            "orderable": false,
            'targets': [0]
        },
        {
            'render': function(data, type, row, meta){
                if(type === 'display'){
                    data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                }

                return data;
            },
            'checkboxes': {
                'selectRow': true,
                'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
            },
            'targets': [0]
        }
    ],
    'select': { style: 'multi',  selector: 'td:first-child'},
    'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
    dom: '<"row"lfB>rtip',
    
} );

function viewPrescription(id) {
    $.ajax({
        url: '{{ route('pharmacy.prescription.show-data') }}',
        type: 'GET',
        data:{
            id: id
        },
        dataType: 'json',
        success: function(data) {
            $('#prescriptionModal').modal('show');
            $('#prescription-content').empty().html(data.view);
        }
    })
}
</script>
@endpush