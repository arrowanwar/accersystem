<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\HqEr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HqErController extends Controller
{
    public function index() {
        return HqEr::with('endorseOrders:id,hq_er_id,memo_no,date')->paginate(20);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'hq_er_no' => ['required','string','max:255','unique:hq_ers,hq_er_no'],
            'date'     => ['required','date'],
            'section'  => ['required','integer', Rule::in([1,2])],
            'nothi_no' => ['nullable','string','max:255'],
            'code'     => ['nullable','integer'],
        ]);
        $er = HqEr::create($data);
        return response()->json($er, 201);
    }

    public function show(HqEr $hqEr) {
        $hqEr->load(['endorseOrders','fieldOfficeErs']);
        return $hqEr;
    }

    public function update(Request $request, HqEr $hqEr) {
        $data = $request->validate([
            'hq_er_no' => ['sometimes','string','max:255','unique:hq_ers,hq_er_no,'.$hqEr->id],
            'date'     => ['sometimes','date'],
            'section'  => ['sometimes','integer', Rule::in([1,2])],
            'nothi_no' => ['nullable','string','max:255'],
            'code'     => ['nullable','integer'],
        ]);
        $hqEr->update($data);
        return $hqEr;
    }

    public function destroy(HqEr $hqEr) {
        $hqEr->delete();
        return response()->noContent();
    }
}
