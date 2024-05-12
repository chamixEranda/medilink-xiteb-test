<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PrescriptionService;
use App\Services\QuotationService;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\CentralLogics\Helpers;
use App\Mail\QuotationMail;
use Illuminate\Support\Facades\Mail;

class QuotationController extends Controller
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
        $lims_quotation_list = $this->quotationService->getQuotationWithPaginate();

        return view('pharmacy.quotation.index', compact('lims_quotation_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $lims_prescription_data = $this->prescriptionService->getPrescriptionByID($request->query('prescription_id'));
        return view('pharmacy.quotation.create', compact('lims_prescription_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'drug_name' => 'required',
            'net_unit_cost' => 'required',
            'qty' => 'required',
            'total' => 'required',
            'total_cost' => 'required',
        ]);

        DB::beginTransaction();

        $data = $request->all();
        $order_id = 100000 + Quotation::all()->count() + 1;
        if (Quotation::find($order_id)) {
            $order_id = Quotation::orderBy('id', 'DESC')->first()->id + 1;
        }

        $prescription_data = $this->prescriptionService->getPrescriptionByID($data['prescription_id']);

        $data['id'] = $order_id;
        $data['prescription_id'] = $prescription_data->id;
        $data['user_id'] = $prescription_data->user_id;
        $data['status'] = 'pending';
        $quotation = $this->quotationService->createQuotation($data);

        foreach ($data['drug_name'] as $key => $drug) {
            $detail_data['quotation_id'] = $quotation->id;
            $detail_data['drug_name'] = $drug;
            $detail_data['net_unit_cost'] = $data['net_unit_cost'][$key];
            $detail_data['qty'] = $data['qty'][$key];
            $detail_data['total'] = $data['total'][$key];
            $quotationDetails = $this->quotationService->createQuotationDetail($detail_data);
        }

        DB::commit();

        // try {
            Mail::to($prescription_data->user->email)->send(new QuotationMail($quotation));
        // } catch (\Exception $e) {
            // return redirect()->back()->with('error', $e->getMessage());
        // }

        return redirect()->route('pharmacy.quotation.index');
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
