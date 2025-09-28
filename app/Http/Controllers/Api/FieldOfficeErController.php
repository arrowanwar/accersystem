<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\FieldOfficeEr;
use Illuminate\Http\Request;

class FieldOfficeErController extends Controller
{
    public function index() {
        return FieldOfficeEr::with([
            'hqEr:id,hq_er_no',
            'officer:id,name',
            'officerEndorsement:id,officer_id,status',
            'accusedServiceInfo:id,name,post,office_short_name',
        ])->paginate(20);
    }

     public function store(Request $request)
    {
        $data = $request->validate([
            'hq_er_id' => ['required','exists:hq_ers,id'], // Check against the ID column
            'officer_id' => ['required','exists:officers,id'],
            'officer_endorsement_id' => ['required','exists:hq_endorse_orders,id'],
            'accused_service_info_id' => ['required','exists:accused_service_infos,id'],
            'accused_present_add_info_id' => ['required','exists:accused_present_add_infos,id'],
            'accused_permanent_add_info_id' => ['required','exists:accused_permanent_add_infos,id'],
        ]);
        $row = FieldOfficeEr::create($data);
        return response()->json($row, 201);
    }

    public function show(FieldOfficeEr $fieldOfficeEr) {
        return $fieldOfficeEr->load([
            'hqEr','enquiryOfficer','endorsement',
            'accusedService','accusedPresentAddress','accusedPermanentAddress'
        ]);
    }

    public function update(Request $request, FieldOfficeEr $fieldOfficeEr)
{
    $data = $request->validate([
        'hq_er_id' => ['sometimes','exists:hq_ers,id'],
        'officer_endorsement_id' => ['sometimes','exists:hq_endorse_orders,id'],
        'accused_service_info_id' => ['sometimes','exists:accused_service_infos,id'],
        'accused_present_add_info_id' => ['sometimes','exists:accused_present_add_infos,id'],
        'accused_permanent_add_info_id' => ['sometimes','exists:accused_permanent_add_infos,id'],
    ]);
    $fieldOfficeEr->update($data);
    return $fieldOfficeEr;
}


    public function destroy(FieldOfficeEr $fieldOfficeEr) {
        $fieldOfficeEr->delete();
        return response()->noContent();
    }
}
