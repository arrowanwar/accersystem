<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HqEndorseOrder;
use Illuminate\Http\Request;

class HqEndorseOrderController extends Controller
{
    public function index() {
        return HqEndorseOrder::with('hqEr:id,hq_er_no')->paginate(20);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'hq_er_id' => ['required','exists:hq_ers,id'],
            'memo_no'  => ['required','string','max:255'],
            'date'     => ['required','date'],
        ]);
        $row = HqEndorseOrder::create($data);
        return response()->json($row, 201);
    }

    public function show(HqEndorseOrder $endorseOrder) {
        return $endorseOrder->load('hqEr');
    }

    public function update(Request $request, HqEndorseOrder $endorseOrder) {
        $data = $request->validate([
            'hq_er_id' => ['sometimes','exists:hq_ers,id'],
            'memo_no'  => ['sometimes','string','max:255'],
            'date'     => ['sometimes','date'],
        ]);
        $endorseOrder->update($data);
        return $endorseOrder;
    }

    public function destroy(HqEndorseOrder $endorseOrder) {
        $endorseOrder->delete();
        return response()->noContent();
    }
}
