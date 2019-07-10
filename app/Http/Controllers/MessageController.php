<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agent = $request->server->get('HTTP_USER_AGENT');
        $matches = preg_match('/Firefox|Chrom|Safari|Edge|Opera|IE|Trident/i', $agent);

        if ($matches) {
            return Message::create($request->all());
        } else {
            return response(['message' => 'Not allowed agent'], 400);
        }
    }
}
