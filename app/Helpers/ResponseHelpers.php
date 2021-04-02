<?php
/**
 * Created by cuongnd
 */

namespace App\Helpers;

class ResponseHelpers
{

    public static function showResponse($data = [], $format = 'array', $message = null)
    {
        $response = [
            "meta" => [
                'status' => 200,
                'message' => !empty($message) ? $message : __('messages.response.success')
            ],
            'response' => !empty($data) ? $data : (!$data) ? $data : []
        ];

        if ($format == 'json') {
            return response()->json($response, $response['meta']['status']);
        } else {
            return $response;
        }
    }

    public static function notFoundResponse($message = null, $format = 'array')
    {
        $response = [
            "meta" => [
                'status' => 404,
                'message' => !empty($message) ? $message : __('messages.response.resource_not_found')
            ],
            'response' => null
        ];

        if ($format == 'json') {
            return response()->json($response, $response['meta']['status']);
        } else {
            return $response;
        }
    }

    public static function serverErrorResponse($data = [], $format = 'array', $message = null)
    {
        $response = [
            "meta" => [
                'status' => 500,
                'message' => !empty($message) ? $message : __('messages.response.internal_server_error')
            ],
            'response' => !empty($data) ? $data : (!$data) ? $data : []
        ];

        if ($format == 'json') {
            return response()->json($response, $response['meta']['status']);
        } else {
            return $response;
        }
    }

    public static function authenticateErrorResponse($message = null, $format = 'array')
    {

        $response = [
            "meta" => [
                'status' => 401,
                'message' => !empty($message) ? $message : __('messages.response.unauthenticated_error')
            ],
            'response' => null
        ];

        if ($format == 'json') {
            return response()->json($response, $response['meta']['status']);
        } else {
            return $response;
        }
    }

    public static function permissionErrorResponse($message = null, $format = 'array')
    {
        $response = [
            "meta" => [
                'status' => 403,
                'message' => !empty($message) ? $message : __('messages.response.execute_access_forbidden')
            ],
            'response' => null
        ];

        if ($format == 'json') {
            return response()->json($response, $response['meta']['status']);
        } else {
            return $response;
        }
    }

    public static function clientBEErrorResponse($message, $format = 'array')
    {
        $response = [
            "meta" => [
                'status' => 422,
                'message' => !empty($message) ? $message : __('messages.response.unprocessable_entity')
            ],
            'response' => null
        ];

        if ($format == 'json') {
            return response()->json($response, $response['meta']['status']);
        } else {
            return $response;
        }
    }

}