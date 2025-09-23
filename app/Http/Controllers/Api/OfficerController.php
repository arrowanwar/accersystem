<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Officer;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    public function index() {
        return Officer::paginate(20);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'joint_current_office_date' => ['nullable','date'],
        ]);
        $row = Officer::create($data);
        return response()->json($row, 201);
    }

    public function show(Officer $officer) {
        return $officer->load('endorsements');
    }

    public function update(Request $request, Officer $officer) {
        $data = $request->validate([
            'name' => ['sometimes','string','max:255'],
            'joint_current_office_date' => ['nullable','date'],
        ]);
        $officer->update($data);
        return $officer;
    }

    public function destroy(Officer $officer) {
        $officer->delete();
        return response()->noContent();
    }
}
