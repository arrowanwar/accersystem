<?php

namespace App\Http\Controllers;

use App\Models\HqEr;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Query all table data using the HqEr model and eager loading relationships.
     */
    public function getAllData(): JsonResponse
    {
        // Use eager loading (with()) to fetch related data in a single query (N+1 avoidance).
        $allData = HqEr::with([
            // Load direct relationship
            'endorseOrders' => function ($query) {
                $query->select('id', 'hq_er_id', 'memo_no', 'date');
            },

            // Load nested relationship (HqEr -> HqEndorseOrder -> OfficerEndorsement)
            'endorseOrders.officerEndorsements' => function ($query) {
                 $query->select('id', 'officer_id', 'hq_endorse_order_id', 'nothi_rcv_date', 'status');
            },

            // Load deep nested relationship (HqEr -> HqEndorseOrder -> OfficerEndorsement -> Officer)
            'endorseOrders.officerEndorsements.officer' => function ($query) {
                $query->select('id', 'name', 'joint_current_office_date');
            },

            // Load direct relationship
            'fieldOfficeErs' => function ($query) {
                $query->select(
                    'id',
                    'hq_er_id',
                    'officer_endorsement_id',
                    'accused_service_info_id',
                    'accused_present_add_info_id',
                    'accused_permanent_add_info_id'
                );
            },

            // Assuming a relationship on FieldOfficeEr to AccusedServiceInfo
            'fieldOfficeErs.accusedServiceInfo' => function ($query) {
                $query->select('id', 'name', 'post', 'office_full_name', 'district');
            },

            // You'd continue to load other relationships like accusedBasicInfo, etc., as needed.

        ])->get();

        return response()->json([
            'success' => true,
            'data' => $allData,
        ]);
    }
}