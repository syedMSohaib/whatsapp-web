<?php

namespace App\Services\ChatApi;

use Carbon\Carbon;

/**
 * Class MessageService
 *
 * @package App\Services\ChatApi
 */
class MessageService extends ChatApiService {
    /**
     * Get dialog all messages
     *
     * @param  string  $dialog  Dialog ID
     *
     * @return array
     */
    public function all (string $dialog) : array {
        $params = [
            'chatId' => $dialog,
        ];

        $response = $this->getRequest('messages', $params);

        $responseStatusCode = $response->getStatusCode();
        $responseBody = json_decode($response->getBody()->getContents(), true);

        if ($responseStatusCode == 200) {
            return $responseBody['messages'];
        }

        return [];
    }

    /**
     * Send message
     *
     * @param  string  $dialogId  Dialog ID
     * @param  string  $body      Message body
     *
     * @return bool
     */
    public function send (string $dialogId, string $body) : array {
        $requestBody = [
            'chatId' => $dialogId,
            'body'   => $body
        ];

        $response = $this->postRequest('sendMessage', $requestBody);

        $responseStatusCode = $response->getStatusCode();
        $responseBody = json_decode($response->getBody()->getContents(), true);

        if ($responseStatusCode == 200) {
            return $responseBody;
        }

        return [];
    }


    /**
     * Send sendMedia
     *
     * @param  string  $dialogId  Dialog ID
     * @param  string  $body      Message body
     *
     * @return bool
     */
    public function sendMediaFile($dialogId, $body, $path) {

        // $filename = microtime().".".$file->getClientOriginalExtension();

        // $new = $file->store('public');

        // $path = asset("/storage/{$filename}");

        $requestBody = [
            'chatId' => $dialogId,
            "body" => $path,
            // "body" => "https://upload.wikimedia.org/wikipedia/ru/3/33/NatureCover2001.jpg",
            // "body" => "https://3f571131c0f4.ngrok.io/storage/yhf4SZiSVFUGG6nFwjMMeSs8bE3FwNorGocu9vZW.jpg",
            "filename" => basename($path),
            "caption" => $body,
        ];

        $response = $this->postRequest('sendFile', $requestBody);

        $responseStatusCode = $response->getStatusCode();
        $responseBody = json_decode($response->getBody()->getContents(), true);

        if ($responseStatusCode == 200) {
            return $responseBody;
        }

        return [];
    }
}
