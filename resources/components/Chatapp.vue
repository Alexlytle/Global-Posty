<template>

    <div class="chat-app">
        
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage" />
        <Contactlist :contacts="contacts" @selected="startConversationWith"/>
         <!-- <Contactlist :contacts="contacts" @selected="startConversationWith"/> -->
    </div>
</template>

<script>
export default {
      props:{
          user:{
              type:Object,
              required:true
          }
      },
        data(){
            return{
                selectedContact:null,
                messages:[],
                contacts:[]
            }
        },
        methods:{
            startConversationWith(contact){
                 this.updateUnreadCount(contact, true);
                axios.get(`/conversation/${contact.id}`)
                    .then((res)=>{
                        this.messages = res.data
                        this.selectedContact = contact
                    })
            },
            saveNewMessage(text){
                this.messages.push(text)
            },
            handleIncoming(message){
                if(this.selectedContact && message.from === this.selectedContact.id){
                    // this.messages.push(message)
                    this.saveNewMessage(message)
                    return;
                }
              
                 this.updateUnreadCount(message.from_contact, false);
            },
            updateUnreadCount(contact,reset){
                this.contacts = this.contacts.map((single) => {
                            if (single.id !== contact.id) {
                                return single;
                            }
                            if (reset)
                                single.unread = 0;
                            else
                                single.unread += 1;
                            return single;
                        })
                console.log(this.contacts)
                        
            }
        },
        mounted(){
  
            // window.Echo.channel('channel').listen('Hello',(e)=>{
            //     console.log(e)
            // })
         
        
            window.Echo.channel(`messages.${this.user.id}`).listen('NewMessage',(e)=>{
                console.log(e,'hello from echo')
                this.handleIncoming(e.message)
            })
            
    

            axios.get('/contacts')
                 .then((res)=>{
                  
                     let filterUser = res.data.filter((data)=>{
                         console.log(data)
                            return data.conversationTo !== 'no' || data.conversationFrom !== 'no'
                        })

                   

                        this.contacts = filterUser
                        
                 })


        }
}
</script>

<style scoped>
.card-body{
    padding: 0;
}
.chat-app {
    display: flex;
}
</style>