@extends('pharmacy.layouts.app')

@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="{{ asset('assets/img/user.jpg') }}" class="w--26" alt="">
            </span>
            <span>
                {{ translate('messages.prescriptions') }}
            </span>
        </h1>
    </div>
    <!-- End Page Header -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h5 class="card-title fw-semibold mb-4">{{ translate('messages.prescription_list') }}</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="prescription-table" class="table">
                <thead>
                    <tr>
                        <th class="not-exported"></th>
                        <th class="border-0">{{ translate('messages.user') }}</th>
                        <th class="border-0">{{ translate('messages.delivery_address') }}</th>
                        <th class="border-0">{{translate('messages.delivery_time')}}</th>
                        <th class="border-0">{{translate('messages.note')}}</th>
                        <th class="border-0 not-exported">{{translate('messages.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lims_prescription_list as $key=> $prescription)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $prescription->user->name.' - '.$prescription->user->email }}</td>
                        <td>{{ $prescription->delivery_address }}</td>
                        <td>{{ $prescription->delivery_time }}</td>
                        <td>{{ $prescription->delivery_note }}</td>
                        <td>
                            <div class="btn--container justify-content-center">
                                <a class="btn action-btn btn--primary btn-outline-primary"
                                    href="javascript:" onclick="viewPrescription({{ $prescription['id'] }})"
                                    title="{{translate('messages.view')}} {{translate('messages.prescription')}}"><i
                                        class="fas fa-eye"></i>
                                </a>
                                <a class="btn action-btn btn--primary btn-outline-primary"
                                    href="{{ route('pharmacy.quotation.create',$prescription['id']) }}"
                                    title="{{translate('messages.make')}} {{translate('messages.quotation')}}"><i
                                        class="fas fa-pen"></i>
                                </a>
                            </div>
                        </td>
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