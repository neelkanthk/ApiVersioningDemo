<?php

namespace App\Helpers;

class ApiHelper {

    public static function prepareApiResponse($data = array(), $code = 204, $errors = array()) {
        $httpStatus = config('api.httpstatus');
        $response = [
            'code' => $code,
            'message' => $httpStatus[$code]
        ];
        if (!empty($data) && empty($errors)) {
            $response['data'] = is_array($data) && !empty($data) ? $data : (array) $data;
        } else if (!empty($errors)) {
            $response['errors'] = is_array($errors) && !empty($errors) ? $errors : (array) $errors;
        }
        return $response;
    }

}
