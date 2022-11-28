<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    protected $oRequest;

    public function __construct(Request $oRequest)
    {
        $this->oRequest =$oRequest;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function receiveEvent() {
        $aData = [
            'data' => $this->oRequest->all(),
            'headers' => $this->oRequest->header()
        ];
        Log::notice('Request data:', $aData);
        $aHeaders = [
            'charset'           =>  'utf-8',
            'Content-Type'      => 'application/json; charset=utf-8'
        ];

        return Response::make('Payload logged', 200, $aHeaders);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function verifyRequest() {
        return Response::make($this->oRequest->hub_challenge);
    }
}
