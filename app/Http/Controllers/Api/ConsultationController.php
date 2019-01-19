<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponse;
use App\Consultation;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuSuggestion;

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

    public function store()
    {
        try {
            $consultation = new Consultation();
            $consultation->user_id = request('user_id');
            $consultation->weight = request('weight');
            $consultation->bed_time = request('bed_time');
            $consultation->activity = request('activity');
            $consultation->pregnancy_age = request('pregnancy_age');
            $consultation->calorie_need = request('calorie_need');
            $consultation->save();

            $menuSuggestion = Menu::getMenuSuggestionByCalorieNeed(request(['calorie_need']));

            foreach ($menuSuggestion as $m) {
                MenuSuggestion::create([
                    'consultation_id' => $consultation->id,
                    'menu_id' => $m['id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            return ApiResponse::success('Consultation Saved', ['menu_suggestion' => $menuSuggestion]);
        } catch (\Exception $e) {
            return ApiResponse::error('User Update Failed');
        }
    }
}
