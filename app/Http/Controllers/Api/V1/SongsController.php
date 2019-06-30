<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Song;
use App\Helpers\ApiHelper;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class SongsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $songs = array();
        try {
            $validator = Validator::make($request->all(), [
                        'limit' => 'int|min:1',
                        'offset' => 'int|min:0',
            ]);

            if ($validator->fails()) {
                $code = 400;
                $response = ApiHelper::prepareApiResponse($songs, $code, $validator->errors()->all());
            } else {
                $songs = Song::select("title", "artist", "genre", "duration")->get()->toArray();
                if (empty($songs)) {
                    $code = 204;
                    $response = ApiHelper::prepareApiResponse($songs, $code);
                } else {
                    $code = 200;
                    $response = ApiHelper::prepareApiResponse($songs, $code);
                }
            }
        } catch (Exception $ex) {
            $code = 500;
            $response = ApiHelper::prepareApiResponse($songs, $code, $ex->getMessage());
        } finally {
            return response()->json($response, $response['code']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $song = array();
        try {
            $song = Song::select("title", "artist", "genre", "duration")->find($id)->toArray();
            if (!empty($song)) {
                $code = 200;
                $response = ApiHelper::prepareApiResponse($song, $code);
            } else {
                $code = 204;
                $data = array();
                $response = ApiHelper::prepareApiResponse($song, $code);
            }
        } catch (Exception $ex) {
            $code = 500;
            $response = ApiHelper::prepareApiResponse($song, $code, $ex->getMessage());
        } finally {
            return response()->json($response, $response['code']);
        }
    }

}
