<?php

namespace App\Http\Controllers;

use App\Classes\MyHttpResponse;
use App\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        return view('partials.consultation.index', ['consultations' => Consultation::all()]);
    }

    public function show(Consultation $consultation)
    {
        return view('partials.consultation.edit', ['consultation' => $consultation]);
    }

    public function destroy(Consultation $consultation)
    {
        try {
            $consultation->delete();
            return MyHttpResponse::deleteResponse(true, 'Consultation Successfully Deleted', 'consultation.index');
        } catch (\Exception $e) {
            return MyHttpResponse::deleteResponse(false, $e->getMessage(), 'consultation.index');
        }
    }
}
