<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\Api\{
    HqErController,
    HqEndorseOrderController,
    OfficerController,
    OfficerEndorsementController,
    AccusedController,
    FieldOfficeErController
};

// HQ ER
Route::get   ('/hq-ers',          [HqErController::class, 'index']);
Route::post  ('/hq-ers',          [HqErController::class, 'store']);
Route::get   ('/hq-ers/{hqEr}',   [HqErController::class, 'show']);
Route::put   ('/hq-ers/{hqEr}',   [HqErController::class, 'update']);
Route::patch ('/hq-ers/{hqEr}',   [HqErController::class, 'update']);
Route::delete('/hq-ers/{hqEr}',   [HqErController::class, 'destroy']);

// HQ Endorse Orders
Route::get   ('/endorse-orders',                [HqEndorseOrderController::class, 'index']);
Route::post  ('/endorse-orders',                [HqEndorseOrderController::class, 'store']);
Route::get   ('/endorse-orders/{endorseOrder}', [HqEndorseOrderController::class, 'show']);
Route::put   ('/endorse-orders/{endorseOrder}', [HqEndorseOrderController::class, 'update']);
Route::patch ('/endorse-orders/{endorseOrder}', [HqEndorseOrderController::class, 'update']);
Route::delete('/endorse-orders/{endorseOrder}', [HqEndorseOrderController::class, 'destroy']);

// Officers
Route::get   ('/officers',         [OfficerController::class, 'index']);
Route::post  ('/officers',         [OfficerController::class, 'store']);
Route::get   ('/officers/{officer}', [OfficerController::class, 'show']);
Route::put   ('/officers/{officer}', [OfficerController::class, 'update']);
Route::patch ('/officers/{officer}', [OfficerController::class, 'update']);
Route::delete('/officers/{officer}', [OfficerController::class, 'destroy']);

// Officer Endorsements
Route::get   ('/officer-endorsements',                      [OfficerEndorsementController::class, 'index']);
Route::post  ('/officer-endorsements',                      [OfficerEndorsementController::class, 'store']);
Route::get   ('/officer-endorsements/{officerEndorsement}', [OfficerEndorsementController::class, 'show']);
Route::put   ('/officer-endorsements/{officerEndorsement}', [OfficerEndorsementController::class, 'update']);
Route::patch ('/officer-endorsements/{officerEndorsement}', [OfficerEndorsementController::class, 'update']);
Route::delete('/officer-endorsements/{officerEndorsement}', [OfficerEndorsementController::class, 'destroy']);

// Accused info (simple endpoints)
Route::get   ('/accused/services',               [AccusedController::class, 'govtServiceAddress']);
Route::post  ('/accused/service',               [AccusedController::class, 'createService']);
Route::put   ('/accused/service/{accusedService}', [AccusedController::class, 'updateService']);
Route::get   ('/accused/present',               [AccusedController::class, 'AccusedPresentAddInfo']);
Route::post  ('/accused/present',               [AccusedController::class, 'createPresentAddress']);
Route::put   ('/accused/present/{present}',     [AccusedController::class, 'updatePresentAddress']);
Route::get   ('/accused/permanent',             [AccusedController::class, 'AccusedPermanentAddInfo']); 
Route::post  ('/accused/permanent',             [AccusedController::class, 'createPermanentAddress']);
Route::put   ('/accused/permanent/{permanent}', [AccusedController::class, 'updatePermanentAddress']);

// Field Office ER
Route::get   ('/field-office-ers',                 [FieldOfficeErController::class, 'index']);
Route::post  ('/field-office-ers',                 [FieldOfficeErController::class, 'store']);
Route::get   ('/field-office-ers/{fieldOfficeEr}', [FieldOfficeErController::class, 'show']);
Route::put   ('/field-office-ers/{fieldOfficeEr}', [FieldOfficeErController::class, 'update']);
Route::patch ('/field-office-ers/{fieldOfficeEr}', [FieldOfficeErController::class, 'update']);
Route::delete('/field-office-ers/{fieldOfficeEr}', [FieldOfficeErController::class, 'destroy']);

Route::get('/all-hq-er-data', [DataController::class, 'getAllData']);