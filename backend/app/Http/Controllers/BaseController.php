<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Presenters\Presenter;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Validation\UnauthorizedException;

class BaseController extends Controller
{
    protected $model;

    public function make(Presenter $presenter) {
        $this->model = $presenter;
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message = null)
    {
//        $response = [
//            'success' => true,
//            'data'    => $result,
//            'message' => $message,
//        ];

        $result['success'] = true;
        $result['message'] = $message;

        return $result;
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['error'] = $errorMessages;
        }

        $response['code'] = $code;
        abort(response()->json($response, $code));
    }
}
