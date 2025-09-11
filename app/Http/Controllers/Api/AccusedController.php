<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccusedServiceInfo;
use App\Models\AccusedPresentAddInfo;
use App\Models\AccusedPermanentAddInfo;
use Illuminate\Http\Request;
use App\Models\FieldOfficeEr;

class AccusedController extends Controller
{
    public function govtServiceAddress() {
        return AccusedServiceInfo::paginate(20);
    }
    public function AccusedPresentAddInfo() {
        return AccusedPresentAddInfo::paginate(20);
    }
     public function AccusedPermanentAddInfo() {
        return AccusedPermanentAddInfo::paginate(20);
    }
    public function createService(Request $request) {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'post' => ['nullable','string','max:255'],
            'office_full_name' => ['nullable','string','max:255'],
            'office_short_name' => ['nullable','string','max:255'],
            'thana' => ['nullable','string','max:255'],
            'district' => ['nullable','string','max:255'],
        ]);
        return response()->json(AccusedServiceInfo::create($data), 201);
    }

    public function updateService(Request $request, AccusedServiceInfo $accusedService) {
        $data = $request->validate([
            'name' => ['sometimes','string','max:255'],
            'post' => ['nullable','string','max:255'],
            'office_full_name' => ['nullable','string','max:255'],
            'office_short_name' => ['nullable','string','max:255'],
            'thana' => ['nullable','string','max:255'],
            'district' => ['nullable','string','max:255'],
        ]);
        $accusedService->update($data);
        return $accusedService;
    }

    public function createPresentAddress(Request $request) {
        $data = $request->validate([
            'text' => ['nullable','string'],
            'thana' => ['nullable','string','max:255'],
            'district' => ['nullable','string','max:255'],
        ]);
        return response()->json(AccusedPresentAddInfo::create($data), 201);
    }

    public function updatePresentAddress(Request $request, AccusedPresentAddInfo $present) {
        $data = $request->validate([
            'text' => ['nullable','string'],
            'thana' => ['nullable','string','max:255'],
            'district' => ['nullable','string','max:255'],
        ]);
        $present->update($data);
        return $present;
    }

    public function createPermanentAddress(Request $request) {
        $data = $request->validate([
            'text' => ['nullable','string'],
            'thana' => ['nullable','string','max:255'],
            'district' => ['nullable','string','max:255'],
        ]);
        return response()->json(AccusedPermanentAddInfo::create($data), 201);
    }

    public function updatePermanentAddress(Request $request, AccusedPermanentAddInfo $permanent) {
        $data = $request->validate([
            'text' => ['nullable','string'],
            'thana' => ['nullable','string','max:255'],
            'district' => ['nullable','string','max:255'],
        ]);
        $permanent->update($data);
        return $permanent;
    }
}
