/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));

const app = new Vue({
	el: '#app',

	data: {
		messages: []
	},

	created() {
		this.fetchMessages();

		Echo.private('conversation')
		.listen('MessageSent', (e) => {
			console.log(e);
		});
	},

	methods: {
		fetchMessages() {
			let conversationId = localStorage.getItem('conversation-id');

			let url = '/api/conversations/' + conversationId + '/messages';

			axios.get(url).then(response => {
				this.messages = response.data.messages.reverse();
			});
		},

		sendMessage(message) {
			let conversationId = localStorage.getItem('conversation-id');

			console.log(message);

			let formData = new FormData();

			formData.append("message", message.message);

			formData.append("image", message.image);

			formData.append("file", message.file);

			let url = '/api/conversations/' + conversationId + '/messages';

			// console.log(message);

			// let data = {'message': message.message};

			this.messages.push({'body': message.message});

			axios.post(url, formData).then(response => {

			})
		}
	}
});

Echo.private('conversation').listen('MessageSent', (e) => {
	// console.log(e);

	this.messages.push({
		sendername: e.sendername,
		conversation: e.conversation,
		message: e.message.message
	})
})
