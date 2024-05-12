<div class="modal-header">
    <h5 class="modal-title" id="exampleModalToggleLabel">{{ translate('messages.view_prescription') }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="box">
            <div class="img-box ">
              @foreach (json_decode($lims_prescription_data->images) as $image)
              <img src="{{ asset(getPrescriptionImagePath($image)) }}" style="object-fit: cover;width:150px;height:150px" alt="">
              @endforeach
            </div>
            <div class="detail-box mt-3">
              <h6 class="font-weight-bold">Delivery Address: {{ $lims_prescription_data->delivery_address }}</h6>
              <h6>Delivery Time: {{ $lims_prescription_data->delivery_time }}</h6>
              <h6>Delivery Note: {{ $lims_prescription_data->delivery_note }}</h6>
              <h6>Recieved At: {{ $lims_prescription_data->created_at }}</h6>
            </div>
          </div>
    </div>
</div>