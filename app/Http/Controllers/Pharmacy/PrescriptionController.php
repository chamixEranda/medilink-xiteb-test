<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PrescriptionService;
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

    public function __construct(PrescriptionService $prescriptionService) {
        // Injecting the PrescriptionService instance into the controller.
        $this->prescriptionService = $prescriptionService;
    }

    public function index()
    {
        //get all the prescription list
        $lims_prescription_list = $this->prescriptionService->getAllPrescription();

        return view('pharmacy.prescription.index',compact('lims_prescription_list'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //get the prescription data by its id
        $lims_prescription_data = $this->prescriptionService->getPrescriptionByID($request->query('id'));

        return response()->json([
            'view' => view('pharmacy.prescription._modal.modal-view', compact('lims_prescription_data'))->render()
        ],200);

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
