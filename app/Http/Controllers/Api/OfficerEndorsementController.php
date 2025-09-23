<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\OfficerEndorsement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OfficerEndorsementController extends Controller
{
    public function index() {
        return OfficerEndorsement::with(['officer:id,name','endorseOrder:id,hq_er_id'])->paginate(20);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'officer_id'          => ['required','exists:officer_tbl,id'],
            'hq_endorse_order_id' => ['required','exists:hq_endorse_order_tbl,id'],
            'nothi_rcv_date'      => ['nullable','date'],
            'status'              => ['nullable','integer', Rule::in([0,1])],
        ]);
        $row = OfficerEndorsement::create($data);
        return response()->json($row, 201);
    }

    public function show(OfficerEndorsement $officerEndorsement) {
        return $officerEndorsement->load(['officer','endorseOrder']);
    }

    public function update(Request $request, OfficerEndorsement $officerEndorsement) {
        $data = $request->validate([
            'officer_id'          => ['sometimes','exists:officer_tbl,id'],
            'hq_endorse_order_id' => ['sometimes','exists:hq_endorse_order_tbl,id'],
            'nothi_rcv_date'      => ['nullable','date'],
            'status'              => ['nullable','integer', Rule::in([0,1])],
        ]);
        $officerEndorsement->update($data);
        return $officerEndorsement;
    }

    public function destroy(OfficerEndorsement $officerEndorsement) {
        $officerEndorsement->delete();
        return response()->noContent();
    }
}
