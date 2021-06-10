@extends('conversations.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('chat/css/styles.css') }}" />
@endsection


@section('scripts')
    <script>
        window.conversations = @json($conversations)
    </script>

@endsection

@section('content')

<div id="app" class="grid">

    <chat-user
    v-on:conversation_obj="handleConversation"
    :conversations="{{json_encode($conversations)}}"></chat-user>

    <div v-if="conversation" class="main">
        <chat-messages
        v-on:messagesent="sendMessage"
        :conversation="conversation" :messages="messages"></chat-messages>
    </div>
    <div v-else  class="main">
        <chat-messages-empty />
    </div>


</div>



    {{-- <h2>Conversations</h2>

    <div class="list-group">
        @forelse($conversations as $conversation)
            <a href="{{ route('conversations.show', ['conversation' => $conversation['id']]) }}"
               class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                {{ $conversation['name'] }}
            </a>
        @empty
            No messages...
        @endforelse
    </div> --}}
@endsection
