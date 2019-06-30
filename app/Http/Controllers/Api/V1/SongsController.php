<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Song;
use App\Helpers\ApiHelper;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
                $limit = !empty($request->limit) ? $request->limit : 5;
                $offset = !empty($request->offset) ? $request->offset : 0;
                $songs = Song::select("id", "title", "artist", "genre", "duration")
                                ->limit($limit)->offset($offset)
                                ->get()->toArray();
                $code = 200;
                $response = ApiHelper::prepareApiResponse($songs, $code);
            }
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
            $song = Song::select("id", "title", "artist", "genre", "duration")->findOrFail($id)->toArray();
            $code = 200;
            $response = ApiHelper::prepareApiResponse($song, $code);
        } catch (ModelNotFoundException $ex) {
            $code = 404;
            $response = ApiHelper::prepareApiResponse($song, $code);
        } finally {
            return response()->json($response, $response['code']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $song = array();
        try {
            $validator = Validator::make($request->all(), [
                        'title' => 'string',
                        'artist' => 'string',
                        'genre' => 'string',
                        'duration' => 'numeric'
            ]);
            if ($validator->fails()) {
                $code = 400;
                $response = ApiHelper::prepareApiResponse($song, $code, $validator->errors()->all());
            } else {
                $song = Song::findOrFail($id);
                $song->update($request->all());
                $code = 200;
                $response = ApiHelper::prepareApiResponse($song->toArray(), $code);
            }
        } catch (ModelNotFoundException $ex) {
            $code = 404;
            $response = ApiHelper::prepareApiResponse($song, $code);
        } finally {
            return response()->json($response, $response['code']);
        }
    }

}
