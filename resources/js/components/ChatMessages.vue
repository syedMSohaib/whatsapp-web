<template>
    <div>
    <div class="chat-window-header">
        <div class="chat-window-header-left">
            <img class="chat-window-contact-image" :src="conversation.image">
            <div class="contact-name-and-status-container">
                <span class="chat-window-contact-name">{{conversation.name}}</span>
                <span class="chat-window-contact-status">Online</span>
            </div>
        </div>
    </div>
    <div class="chat-window">

        <div v-for="(message, mid) in messages" :key="mid" :class="message.fromMe ? 'sender' : 'receiver'">

            <div v-if="validURL(message.body)" class="image-message">
                <span :class="message.fromMe ? 'sender-message' : 'receiver-message'">
                    <img v-if="checkImageURL(message.body)"  :src="message.body">
                    <a v-else style="color: #039be5" target="_blank" :href="message.body">{{message.body}}</a>
                </span>
                <!-- <span class="message-time">21:36</span> -->
            </div>
            <fragment v-else>
                <span class="sender-message-tail">
                    <img :src="`${baseurl}/chat/images/message-tail-sender.svg`"></span>
                <span class="sender-message">{{ message.body }}</span>
            </fragment>
            <span class="message-time">
                <timeago :datetime="new Date(message.time * 1000)"></timeago>
            </span>
        </div>

    </div>
    <div class="type-message-bar">
        <input ref="fileselector" @change="handleMedia" type="file" style="display: none">
        <input ref="imageselector" @change="handleImage" type="file" accept="image/*" style="display: none">

        <div class="type-message-bar-left">
            <img @click="$refs.imageselector.click()" :src="`${baseurl}/chat/images/camera-icon.svg`">
            <img @click="$refs.fileselector.click()" :src="`${baseurl}/chat/images/attach-icon.svg`">
        </div>
        <div class="type-message-bar-center">
            <input v-model="newMessage" @keyup.enter="sendMessage" type="text" placeholder="Type a message">
        </div>
        <div @click="sendMessage" class="type-message-bar-right">
            <img :src="`${baseurl}/chat/images/play-audio-icon.svg`">
        </div>
        <div class="bottom row">
            <p v-if="image">{{image.name}}</p>
            <br>
            <p v-if="file">{{file.name}}</p>
        </div>

    </div>
    </div>
</template>
<style>
</style>

<script>
import { Fragment } from 'vue-fragment'
export default {
  props: ['messages', 'conversation'],
  components: { Fragment },
  data() {
      return {
            baseurl: window.Laravel.baseurl,
            mime: ['jpg', 'jpeg', 'png', 'bmp', 'gif'],
            newMessage: '',
            file: '',
            image: '',

      }
  },
  mounted() {
      setTimeout( () => {
        $(".chat-window").scrollTop($(".chat-window")[0].scrollHeight);
      }, 1000);
  },
  methods: {
    validURL(str) {
        var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
            '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
            '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
            '(\\#[-a-z\\d_]*)?$','i'); // fragment locator

        let result = !!pattern.test(str);

        // if(result)
        //     console.log(this.get_url_extension(str));

        return result;
    },
    checkImageURL(url) {
        return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
    },
    get_url_extension( url ) {
        return url.split(/[#?]/)[0].split('.').pop().trim();
    },
    handleMedia(e){
        this.file = e.target.files[0];
    },
    handleImage(e){
        this.image = e.target.files[0];
    },
    sendMessage() {
      this.$emit('messagesent', {
        conversationId: this.conversation.id,
        sendername: this.conversation.name,
        message: this.newMessage,
        file: this.file,
        image: this.image,
      });

      this.newMessage = '';
      this.image = '';
      this.file = '';
    }
  },
  watch: {
      'messages' : function(){
        $(".chat-window").scrollTop($(".chat-window")[0].scrollHeight);
      }
  }

};
</script>
