/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('chat-messages-empty', require('./components/ChatMessagesEmpty.vue'));
Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));
Vue.component('chat-user', require('./components/ChatUser.vue'));
import { Plugin } from 'vue-fragment'


const app = new Vue({
	el: '#app',
    components: {
        Plugin
    },
	data: {
        baseurl: window.Laravel.baseurl,
		messages: [],
        conversation: undefined,
	},

	created() {
		this.fetchMessages();


		window.Echo.private('conversation')
            .listen('MessageSent', (e) => {
                if(!this.conversation) {
                    this.setCounter(e.conversation);
                }
                else{
                    if(this.conversation.id == e.conversation) {
                        this.messages.push({
                            'body': e.payload.body,
                            'fromMe': false,
                        });
                    }
                    else{
                        this.setCounter(e.conversation);
                    }
                }

                console.log('MessageSent', e);
            });
	},
    mounted(){
		window.Echo.private('conversation')
            .listen('messagesent', (e) => {
                console.log('messagesent', e);
            });
        // console.log("mounted");
        // Echo.join('conversation')
        // .listen('MessageSent', (event) => {
        //     console.log(event);
        // });

    },
	methods: {
        setCounter(conversation){
            let elem = document.getElementById(conversation);
            elem.textContent = Number(elem.textContent) + 1;
            elem.style.display = 'block';
        },
        handleConversation(data){
            this.conversation = data;
            // console.log('data', data);
            this.fetchMessages(data.id);
        },
		fetchMessages(conversationId) {

			let url = '/api/conversations/' + conversationId + '/messages';

			axios.get(url).then(response => {
				this.messages = response.data.messages;
			});
		},

		sendMessage(message) {

            let conversationId = message.conversationId;

			let formData = new FormData();

			formData.append("message", message.message);

			formData.append("image", message.image);

			formData.append("file", message.file);

			let url = '/api/conversations/' + conversationId + '/messages';

			this.messages.push({
                'body': message.message,
                'fromMe': true,
            });

			axios.post(url, formData).then(response => {

			})
		}
	}
});

window.Echo.join('conversation').listen('MessageSent', (e) => {

    console.log(e);

	// this.messages.push({
	// 	sendername: e.sendername,
	// 	conversation: e.conversation,
	// 	message: e.message.message
	// })
})
