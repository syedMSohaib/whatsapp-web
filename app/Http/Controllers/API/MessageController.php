<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Services\ChatApi\MessageService;

use App\Events\MessageSent;
use http\Message;

/**
 * Class MessageController
 *
 * @package App\Http\Controllers\API
 */
class MessageController extends Controller {
    private $messageService;

    public function __construct (MessageService $messageService) {
        $this->messageService = $messageService;
    }

    /**
     * Get conversation messages
     *
     * @param  string  $conversation
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function get (string $conversation) {
        $messages = $this->messageService->all($conversation);

        return response(['messages' => $messages], Response::HTTP_OK);
    }

    /**
     * Send message
     *
     * @param  Request  $request
     * @param  string   $conversation
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function send (Request $request, string $conversation) {

        if($request->file('file') || $request->file('image')){

            $message = $this->messageService->sendMediaFile($conversation, $request->get('message'), $request->file('file') ?? $request->file('image')  );
        }
        else{

            $message = $this->messageService->send($conversation, $request->get('message'));

        }

        // broadcast(new MessageSent($conversation, $request->get('message')))->toOthers();

        return response(['msg' => 'success', 'message' => $request->get('message')], Response::HTTP_OK);

    }
}
