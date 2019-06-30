<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;
use App\Song;
use App\Helpers\ApiHelper;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\V1\SongsController as ApiV1SongsController;

class SongsController extends ApiV1SongsController {

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
                $songs = Song::select("id", "title", "artist", "genre", "duration", "total_likes")
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
            $song = Song::select("id", "title", "artist", "genre", "duration", "total_likes")->findOrFail($id)->toArray();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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
                $song = new Song;
                $song->title = $request->title;
                $song->artist = $request->artist;
                $song->genre = $request->genre;
                $song->duration = $request->duration;
                $song->save();
                $code = 201;
                $response = ApiHelper::prepareApiResponse($song->toArray(), $code);
            }
        } finally {
            return response()->json($response, $response['code']);
        }
    }

}
