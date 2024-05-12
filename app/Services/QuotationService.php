<?php

namespace App\Services;

use App\Models\Quotation;
use App\Models\QuotationDetail;

class QuotationService
{
    public function getAllQuotation() {
        return Quotation::all();
    }

    public function getQuotationWithPaginate($per_page = 10) {
        return Quotation::paginate($per_page);
    }

    public function getQuotationWithPaginateByUser($user_id,$per_page = 10) {
        return Quotation::where('user_id', $user_id)->paginate($per_page);
    }

    public function createQuotation($data) {
        return Quotation::create($data);
    }

    public function createQuotationDetail($data) {
        return QuotationDetail::create($data);
    }

    public function getQuotationByQuotationId($quotation_id) {
        return Quotation::where('quotation_id', $quotation_id)->get();
    }

    public function getQuotationByID($id) {
       return Quotation::find($id);
    }

    public function updateQuotation($data, $id) {

        $quotation = Quotation::find($id);

        if($quotation) {
            $quotation->update($data);
        }

        return $quotation->refresh();
    }

    public function deleteQuotation($id) {

        $quotation = Quotation::find($id);

        if($quotation) {
            $quotation->delete();
        }
    }
}