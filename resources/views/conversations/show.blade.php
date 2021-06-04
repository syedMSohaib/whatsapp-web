@extends('conversations.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('chat/css/styles.css') }}" />
@endsection

@section('scripts')
    <script>
		localStorage.setItem('conversation-id', '{{ $conversation['id'] }}');
    </script>
@endsection

@section('content')

    <div id="app" class="grid">
      {{-- <!-- App background -->
      <div class="top"></div>
      <div class="bottom"></div>
      <!-- App --> --}}

      <div class="app">
        <chat-user :messages="messages"></chat-user>

        <chat-messages :messages="messages"></chat-messages>
        <chat-form
            v-on:messagesent="sendMessage"
            :sendername="{{ json_encode($conversation['name']) }}"
        ></chat-form>

        {{-- <div class="main">
          <!-- Main chat window header -->
          <div class="chat-window-header">
            <div class="chat-window-header-left">
              <img
                class="chat-window-contact-image"
                src="images/timmy-m-harley.jpg"
              />
              <div class="contact-name-and-status-container">
                <span class="chat-window-contact-name">Timmy M Harley</span>
                <span class="chat-window-contact-status">Online</span>
              </div>
            </div>
            <div class="chat-window-header-right">
              <img
                class="chat-window-search-icon"
                src="images/search-icon.svg"
              />
              <img class="chat-window-menu-icon" src="images/menu-icon.svg" />
            </div>
          </div>
          <!-- Chat window -->
          <div class="chat-window">
            <div class="sender">
              <span class="sender-message-tail"
                ><img src="./images/message-tail-sender.svg"
              /></span>
              <span class="sender-message">Hey! How's it going??</span>
              <span class="message-time">21:32</span>
              <span class="message-status"
                ><img src="./images/double-check-seen.svg"
              /></span>
            </div>
            <div class="receiver">
              <span class="receiver-message-tail"
                ><img src="./images/message-tail-receiver.svg"
              /></span>
              <span class="receiver-message"
                >I'm doing fine! What about you??</span
              >
              <span class="message-time">21:35</span>
            </div>
            <div class="sender">
              <span class="sender-message-tail"
                ><img src="./images/message-tail-sender.svg"
              /></span>
              <span class="sender-message"
                >I'm good but I'm sooo bored 🥱🥱🥱</span
              >
              <span class="message-time">21:35</span>
              <span class="message-status"
                ><img src="./images/double-check-seen.svg"
              /></span>
            </div>
            <div class="receiver">
              <span class="receiver-message-tail"
                ><img src="./images/message-tail-receiver.svg"
              /></span>
              <span class="receiver-message">Check this out...</span>
              <span class="message-time">21:36</span>
            </div>
            <div class="receiver">
              <span class="receiver-message">😝😝😝</span>
              <span class="message-time">21:36</span>
            </div>
            <div class="receiver image-message">
              <span class="receiver-message"
                ><img src="./images/meme-coding.png"
              /></span>
              <span class="message-time">21:36</span>
            </div>
            <div class="receiver image-message">
              <span class="receiver-message"
                ><img src="./images/meme-khaleesi.jpg"
              /></span>
              <span class="message-time">21:36</span>
            </div>
            <div class="receiver receiver-audio-message">
              <div class="audio-message">
                <div class="audio-message-left">
                  <img src="images/play-audio-icon.svg" />
                </div>
                <div class="audio-message-center">
                  <div class="audio-message-center-top">
                    <span class="audio-message-bar"></span>
                    <input type="range" min="0" max="100" value="75" />
                  </div>
                  <div class="audio-message-center-bottom">
                    <div class="audio-message-bottom">
                      <span class="audio-message-length">1:15</span>
                      <span class="message-time">21:38</span>
                    </div>
                  </div>
                </div>
                <div class="audio-message-right">
                  <img
                    class="audio-message-contact-image"
                    src="images/timmy-m-harley.jpg"
                  />
                  <img
                    class="audio-message-microphone"
                    src="images/microphone-seen.svg"
                  />
                </div>
              </div>
            </div>
            <div class="sender">
              <span class="sender-message-tail"
                ><img src="images/message-tail-sender.svg"
              /></span>
              <span class="sender-message">hahahahahah</span>
              <span class="message-time">21:39</span>
              <span class="message-status"
                ><img src="./images/double-check-seen.svg"
              /></span>
            </div>
            <div class="sender">
              <span class="sender-message">🤣🤣🤣🤣</span>
              <span class="message-time">21:39</span>
              <span class="message-status"
                ><img src="./images/double-check-seen.svg"
              /></span>
            </div>
            <!-- Type message bar -->
            <div class="type-message-bar">
              <div class="type-message-bar-left">
                <img src="images/icons.svg" />
                <img src="images/attach-icon.svg" />
              </div>
              <div class="type-message-bar-center">
                <input type="text" placeholder="Type a message" />
              </div>
              <div class="type-message-bar-right">
                <img src="images/audio-icon.svg" />
              </div>
            </div>
          </div>
        </div> --}}

    </div>
    </div>

@endsection
