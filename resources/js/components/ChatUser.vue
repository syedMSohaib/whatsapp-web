<template>
    <div class="sidebar">
          <div class="sidebar-header">
            <img :src="`${baseurl}/chat/images/placeholder-image.svg`" />
            <div class="sidebar-header-icons">
            </div>
          </div>
          <!-- Sidebar notifications -->
          <div class="sidebar-notifications">
            <img :src="`${baseurl}/chat/images/notifications.svg`" />
            <div class="sidebar-notifications-message">
              <span>Get Notified of New Messages</span>
              <a href="#"
                >Turn on desktop notifications <img :src="`${baseurl}/chat/images/gt-arrow.svg`"/></a>
            </div>
          </div>
          <!-- Sidebar search chat -->
          <div class="search-chat">
            <div class="search-bar">
              <img :src="`${baseurl}/chat/images/search-icon.svg`" />
              <input type="text" placeholder="Search or start new chat" />
            </div>
          </div>
          <!-- Chats -->
          <div class="chats">
            <!-- Alice -->
            <div class="chat" @click="chatWith(conversation)" v-for="(conversation, cid) in conversations" :key="cid">
              <div class="chat-left">
                <img :src="conversation.image || `${baseurl}/chat/images/placeholder-image.svg`" />
              </div>
              <div class="chat-right">
                <div class="chat-right-top">
                  <span class="contact-name" v-text="conversation.name"></span>
                  <span class="chat-date" v-text="conversation.last_time"></span>
                </div>
                <div class="chat-right-bottom">
                  <div class="chat-right-bottom-left">
                    <span class="chat-message-typing"></span>
                  </div>
                  <div class="chat-right-bottom-right">
                    <!-- <span class="unread-messages-number">3</span>
                    <span class="chat-options">
                      <img :src="`${baseurl}/chat/images/down-arrow.svg`" />
                    </span> -->
                  </div>
                </div>
              </div>
            </div>

          </div>
    </div>
</template>


<script>
export default {
  props: ['conversations'],
  data() {
    return {
        baseurl: window.Laravel.baseurl
    }
  },
  methods: {
        chatWith(conversation){
            console.log("Setting Conversation ID: "+conversation.id);
            this.$emit('conversation_obj', {
                id: conversation.id,
                name: conversation.name,
                image: conversation.image ||  `${baseurl}/chat/images/placeholder-image.svg`
            });
        }
  }
}
</script>
