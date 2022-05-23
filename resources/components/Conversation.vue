<template>
    <div class="conversation">
           <h1>{{ contact ? contact.name : 'Select a Contact' }}</h1>
            <Messagesfeed :contact="contact" :messages="messages" />
            <Messagecomposer @send="sendMessage"/>
    </div>
</template>

<script>
export default {
        props:{
            contact:{
                type:Object,
                required:false,
                default:null,
                
          
            },
            messages:{
                type:Array,
                default:[]
            }
        },
        methods:{
            sendMessage(text){
                console.log(text)
                if(!this.contact){
                    return;
                }
                axios.post('/conversation/send',{
                    contact_id:this.contact.id,
                    text:text
                }).then((res)=>{
                                   
                    this.$emit('new',res.data)

                })
            }
        }
}
</script>

<style lang="scss" scoped>
.conversation {
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    h1 {
        font-size: 20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgray;
    }
}
</style>