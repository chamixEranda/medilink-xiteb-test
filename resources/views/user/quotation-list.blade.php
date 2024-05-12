@extends('user.layouts.app')

@section('content')

<section class="doctor_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          {{ translate('messages.My_Prescriptions') }}
        </h2>
      </div>
      <div class="row">
        @foreach ($lims_prescription_list as $prescription)
        <div class="col-sm-6 col-lg-4 mx-auto">
          <div class="box">
            <div class="img-box">
              @foreach (json_decode($prescription->images) as $image)
              <img src="{{ asset(getPrescriptionImagePath($image)) }}" alt="">
              @endforeach
            </div>
            <div class="detail-box">
              <h5 class="font-weight-bold">{{ $prescription->delivery_address }}</h5>
              <h6>{{ $prescription->delivery_time }}</h6>
              <h6>{{ $prescription->delivery_note }}</h6>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="col-sm-auto">
        <div class="d-flex justify-content-center justify-content-sm-end">
            {!! $lims_prescription_list->links() !!}
        </div>
      </div>
    </div>
</section>
    
@endsection