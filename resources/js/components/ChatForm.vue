<template>
<div>
  <div class="input-group">
    <input ref="fileselector" @change="handleMedia" type="file" style="display: none">
    <input ref="imageselector" @change="handleImage" type="file" accept="image/*" style="display: none">
    <button @click="$refs.fileselector.click()" type="button">
      File
    </button>
    <button @click="$refs.imageselector.click()" type="button">
      Image
    </button>

    <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

    <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
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
