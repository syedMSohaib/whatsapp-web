<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use App\Events\MessageSent;

/**
 * Class MessageBirdController
 *
 * @package App\Http\Controllers\Webhooks
 */
class MessageBirdController extends Controller {
    /**
     * Get conversations page
     *
     * @return View
     */
    public function index (Request $request)  {
        Log::info(request()->all());

        broadcast(new MessageSent($conversation, $request->get('message')))->toOthers();

    }
}
