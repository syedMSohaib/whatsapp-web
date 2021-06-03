<template>
  <ul class="chat">
    <li class="left clearfix" v-for="(message, mid) in messages" :key="mid">
      <div class="chat-body clearfix text-right" v-if="message.fromMe">

        <p v-if="validURL(message.body)">

          <img v-if="mime.includes(get_url_extension(message.body))" :src="message.body">
          <a v-else :href="message.body">{{ message.body }}</a>
        </p>
        <p v-else v-text="message.body"></p>
      </div>

      <div class="chat-body clearfix pull-right" v-else-if="!message.fromMe">
        <div class="header">
          <strong class="primary-font">
            {{ message.senderName }}
          </strong>
        </div>
        <p v-if="validURL(message.body)">
          <img v-if="mime.includes(get_url_extension(message.body))" :src="message.body">
          <a v-else :href="message.body">{{ message.body }}</a>
        </p>
        <p v-else v-text="message.body"></p>
      </div>
    </li>
  </ul>
</template>
<style>
    img {
        width: 200px;
        height: 200px;
        object-fit: contain;
    }
</style>

<script>
export default {
  props: ['messages'],
  data() {
      return {
          mime: ['jpg', 'jpeg', 'png', 'bmp', 'gif'],
      }
  },
  mounted() {
      window.onload = () => {
        $(".panel-body").scrollTop($(".panel-body")[0].scrollHeight);
      }
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

        if(result)
            console.log(this.get_url_extension(str));

        return result;
    },
    get_url_extension( url ) {
        return url.split(/[#?]/)[0].split('.').pop().trim();
    }
  }

};
</script>
