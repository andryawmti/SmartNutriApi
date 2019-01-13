<?php

namespace App\Http\Controllers;

use App\Classes\MyHttpResponse;
use App\Urt;

class UrtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        return view('manage.urt.index', ['urts' => Urt::all()]);
    }

    public function store()
    {
        request()->validate([
            'slug' => 'required',
            'name' => 'required',
        ]);

        try {
            $urt = new Urt();
            $urt->slug = request('slug');
            $urt->name = request('name');
            $urt->save();

            return MyHttpResponse::storeResponse(true, 'URT Successfully Created', 'urt.index');
        } catch (\Exception $e) {
            return MyHttpResponse::storeResponse(false, $e->getMessage(), 'urt.index');
        }
    }

    public function show(Urt $urt)
    {
        return view('manage.urt.edit', ['urt' => $urt]);
    }

    public function update(Urt $urt)
    {
        request()->validate([
            'slug' => 'required',
            'name' => 'required',
        ]);

        try {
            $urt = new Urt();
            $urt->slug = request('slug');
            $urt->name = request('name');
            $urt->save();

            return MyHttpResponse::updateResponse(true, 'URT Successfully Updated', 'urt.show', $urt->id);
        } catch (\Exception $e) {
            return MyHttpResponse::updateResponse(false, $e->getMessage(), 'urt.index', $urt->id);
        }
    }

    public function destroy(Urt $urt)
    {
        try {
            $urt->delete();
            return MyHttpResponse::deleteResponse(true, 'URT Successfully Deleted', 'urt.index');
        } catch (\Exception $e) {
            return MyHttpResponse::deleteResponse(false, $e->getMessage(), 'urt.index');
        }
    }
}
