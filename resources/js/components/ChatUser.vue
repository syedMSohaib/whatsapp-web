<template>
    <div class="sidebar" style="min-width: 300px;">
        <div class="sidebar-header">
            <img :src="`${baseurl}/chat/images/placeholder-image.svg`" />
            <div class="sidebar-header-icons">

                <div class="dropdown dropleft">
                    <button class="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img :src="`${baseurl}/chat/images/menu-icon.svg`">
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" :href="`${baseurl}/`">Home</a>
                        <a class="dropdown-item" :href="`${baseurl}/conversations`">Refresh</a>
                        <a class="dropdown-item" :href="`${baseurl}/logout`">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar notifications -->
        <div class="sidebar-notifications">
            <img :src="`${baseurl}/chat/images/notifications.svg`" />
            <div class="sidebar-notifications-message">
                <span>Get Notified of New Messages</span>
                <a href="#">Turn on desktop notifications <img :src="`${baseurl}/chat/images/gt-arrow.svg`" /></a>
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
                            <span style="display:none" :id="conversation.id" class="unread-messages-number"></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>


<script>
    import EventBus from "../EventBus";
    export default {
        props: ['conversations'],
        data() {
            return {
                baseurl: window.Laravel.baseurl,
                current_conversation_id: undefined,
            }
        },
        mounted() {
            EventBus.$on('UPDATE_CONVERSATIONS', (payload) => {
                console.log('UPDATE_CONVERSATIONS', payload);
                this.conversations = payload;
            })
        },
        methods: {
            clearCounter(conversation) {
                let elem = document.getElementById(conversation);
                if (!elem) return;
                elem.textContent = 0;
                elem.style.display = 'none';
            },
            chatWith(conversation) {
                console.log("Setting Conversation ID: " + conversation.id);
                this.current_conversation_id = conversation.id;
                this.clearCounter();
                this.$emit('conversation_obj', {
                    id: conversation.id,
                    name: conversation.name,
                    image: conversation.image || `${this.baseurl}/chat/images/placeholder-image.svg`
                });
            }
        }
    }
</script>
