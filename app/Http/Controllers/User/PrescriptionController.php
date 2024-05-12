<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PrescriptionService;
use App\Services\QuotationService;
use Illuminate\Support\Facades\DB;
use App\Http\CentralLogics\Helpers;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $prescriptionService;
    protected $quotationService;

    public function __construct(PrescriptionService $prescriptionService, QuotationService $quotationService) {
        $this->prescriptionService = $prescriptionService;
        $this->quotationService = $quotationService;
    }

    public function index()
    {
        $lims_quotation_list = $this->quotationService->getQuotationWithPaginateByUser(auth()->user()->id);
        return view('user.quotation-list', compact('lims_quotation_list'));
    }

    public function status(Request $request)
    {
        // dd($request);
        $lims_quotation_data = $this->quotationService->getQuotationByID($request->id);
        $lims_quotation_data->update(['status' => $request->status]);

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'delivery_address'  => 'required|max:255',
            'delivery_time'     => 'required',
            'images.*'          => 'image|mimes:jpeg,png,jpg|max:2048',
            'images'            => 'required|max:5',
        ]);

        DB::beginTransaction();

        $logged_user = auth()->user()->id;
        $images = [];
        foreach ($request->file('images') as $image) {
            // Handle each image upload here
            $imageName = $image->getClientOriginalName();
            $extension = strtolower($image->getClientOriginalExtension());
            $images[] = Helpers::upload('prescription/'.$logged_user, $extension, $image);
        }

        $data = $request->all();
        $data['user_id'] = $logged_user;
        $data['images'] = json_encode($images);

        $this->prescriptionService->createPrescription($data);

        DB::commit();

        return redirect()->route('prescription.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
