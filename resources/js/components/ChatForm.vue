<template>
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

</template>


<script>
export default {
  props: ['sendername'],

  data() {
    return {
      baseurl: window.Laravel.baseurl,
      newMessage: '',
      file: '',
      image: '',
    }
  },

  methods: {
    handleMedia(e){
        this.file = e.target.files[0];
    },
    handleImage(e){
        this.image = e.target.files[0];
    },
    sendMessage() {
      this.$emit('messagesent', {
        sendername: this.sendername,
        message: this.newMessage,
        file: this.file,
        image: this.image,
      });

      this.newMessage = '';
      this.image = '';
      this.file = '';
    }
  }
}
</script>
