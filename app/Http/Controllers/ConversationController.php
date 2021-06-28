<?php

namespace App\Http\Controllers;

use App\Exceptions\ArchiveConversationFailureException;
use App\Exceptions\UnarchiveConversationFailureException;
use Illuminate\View\View;

use App\Services\ChatApi\DialogService;
use App\Services\ChatApi\MessageService;

/**
 * Class ConversationController
 *
 * @package App\Http\Controllers
 */
class ConversationController extends Controller {
    /**
     * Dialog service
     *
     * @var DialogService $dialogService
     */
    private $dialogService;

    /**
     * Message service
     *
     * @var MessageService $dialogService
     */
    private $messageService;

    /**
     * ConversationController constructor.
     *
     * @param  DialogService   $dialogService
     * @param  MessageService  $messageService
     */
    public function __construct (DialogService $dialogService, MessageService $messageService) {
        $this->dialogService = $dialogService;
        $this->messageService = $messageService;
    }

    /**
     * Get conversations page
     *
     * @return View
     */
    public function index () : View {
        $conversations = $this->dialogService->all();

        return view('conversations.index')
            ->with(['conversations' => $conversations]);
    }

    /**
     * Get specific conversation with messages
     *
     * @param  string  $conversation
     *
     * @return View
     */
    public function show (string $conversation) : View {
        $conversation = $this->dialogService->get($conversation);
        return view('conversations.show')
            ->with([
                'conversation' => $conversation,
            ]);
    }


    public function getConversations(){
        return $this->dialogService->all();

    }

    public function archiveConversation(int $conversation_id)
    {
        try {
            $this->dialogService->archive($conversation_id);

            return response()->json(["status" => "success"], 200);
        } catch (ArchiveConversationFailureException $exception) {
            return response()->json(["status" => "failure"], $exception->getStatusCode());
        }
    }

    public function unarchiveConversation(int $conversation_id)
    {
        try {
            $this->dialogService->unarchive($conversation_id);

            return response()->json(["status" => "success"], 200);
        } catch (UnarchiveConversationFailureException $exception) {
            return response()->json(["status" => "failure"], $exception->getStatusCode());
        }
    }
}
