<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponse;
use App\Consultation;
use App\Http\Controllers\Controller;

class ConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function findAllByUserId($userId)
    {
        return ApiResponse::data(Consultation::findAllByUserId($userId)->toArray());
    }

    public function calculateWithCooper()
    {

    }

}
