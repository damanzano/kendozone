<?php

namespace App\Http\Controllers;

use App\Championship;
use App\ChampionshipSettings;
use App\Tournament;
use DaveJamesMiller\Breadcrumbs\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class ChampionshipSettingsController extends Controller
{

    protected $currentModelName, $defaultSettings;

    public function __construct()
    {
        // Fetch the Site Settings object
        $this->currentModelName = trans_choice('core.categorySettings', 2);
        View::share('currentModelName', $this->currentModelName);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $championshipId)
    {
        $request->request->add(['championship_id' => $championshipId]);

        $setting = ChampionshipSettings::create($request->all());
        if ($setting != null) {
            return Response::json(['settingId' => $setting->id, 'msg' => trans('msg.category_create_successful'), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.category_create_error'), 'status' => 'error']);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $championshipId
     * @param $championshipSettingsId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $championshipId, $championshipSettingsId)
    {
        try {
            ChampionshipSettings::findOrFail($championshipSettingsId)->update($request->all());
            return Response::json(['msg' => trans('msg.category_update_successful'), 'status' => 'success']);
        } catch (Exception $e) {
            return Response::json(['msg' => trans('msg.category_update_error'), 'status' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ChampionshipSettings $cs
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ChampionshipSettings $cs)
    {
        try {
            $cs->delete();
            return Response::json(['msg' => trans('msg.category_delete_succesful'), 'status' => 'success']);
        } catch (Exception $e) {
            return Response::json(['msg' => trans('msg.category_delete_error'), 'status' => 'error']);
        }
    }

}
