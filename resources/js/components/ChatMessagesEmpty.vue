<template>
    <div>
        <div class="chat-window">
        </div>
        <div class="dummy-bg">

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

      }
  },
  mounted() {
  },
  methods: {
  },
  watch: {
  }

};
</script>
