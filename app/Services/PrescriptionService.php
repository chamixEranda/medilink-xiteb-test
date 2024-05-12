<?php

namespace App\Services;

use App\Models\Prescription;

class PrescriptionService
{
    public function getAllPrescription() {
        return Prescription::all();
    }

    public function getPrescriptionWithPaginate($per_page = 10) {
        return Prescription::paginate($per_page);
    }

    public function getPrescriptionWithPaginateByUser($user_id,$per_page = 10) {
        return Prescription::where('user_id', $user_id)->paginate($per_page);
    }

    public function createPrescription($data) {
        return Prescription::create($data);
    }

    public function getPrescriptionByID($id) {
       return Prescription::find($id);
    }

    public function updatePrescription($data, $id) {

        $prescription = Prescription::find($id);

        if($prescription) {
            $prescription->update($data);
        }

        return $prescription->refresh();
    }

    public function deletePrescription($id) {

        $prescription = Prescription::find($id);

        if($prescription) {
            $prescription->delete();
        }
    }
}
