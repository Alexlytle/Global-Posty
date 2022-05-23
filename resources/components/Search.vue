<template>
    
    <div class="mt-4 mb-4 text-align-center">
        <input type="text"  class="form-control"  @keyup="handleTextInput">
    </div>

    <div class="col-md-4"   v-if="hideMounted == true"  v-for="(user,index) in users" :key="index" >
        <a class="user-box-link"   :href="`/users/${user.id}/posts`">
        <div class="user-box">
                 <p>Display:   {{user.name}}</p>
                <p>City: {{user.placename}}</p>
                <p>State:  {{user.state}}</p>
                <p>Country: {{user.country}}</p>
        </div>
        </a>
    </div>
    <div class="col-md-4"   v-if="hideMounted == false"  v-for="(user,index) in newValue" :key="index" >
        <a class="user-box-link"   :href="`/users/${user.id}/posts`">
        <div class="user-box">
                 <p>Display:   {{user.name}}</p>
                <p>City: {{user.placename}}</p>
                <p>State:  {{user.state}}</p>
                <p>Country: {{user.country}}</p>
        </div>
        </a>
    </div>
    <div class="d-flex">
    <div v-for="(link,index) in links" :key="index" >
            <div class="">
 <a   v-if="link.active == false" @click="handleChangeUrl(link.url)"> {{link.label}}</a>
            </div>
         
    </div>
    </div>



</template>

<script>
export default {



    data(){
        return{
            users:[],
            typingtimer:'',
            previous:'',
            newValue :[],
            hideMounted:true,
            links:[]
        }
    },
    created(){
            axios.get(`http://127.0.0.1:8000/api/users`)
                    .then((res)=>{
                     this.users = res.data.data
                     console.log(this.users)
                    // this.links = res.data.links
                // console.log(this.links)
                    })
     
               
    },
    methods:{
        handleChangeUrl(url){
                 axios.get(`${url}`)
                    .then((res)=>{
                        console.log(res)
                          this.users = res.data.data

                    })
        },
        handleTextInput(e){
       
                // this.users = ''
            let search = e.target.value.toLowerCase()
     
      
                        this.display(search)
            
           
        },
        display(search){
                 let matches  = this.users.filter((user)=>{
                        const regex = new RegExp(`^${search}`, 'gi');
                     return user.name.match(regex) || user.placename.match(regex) ||  user.state.match(regex) ||user.country.match(regex)
            
              })
                   console.log(matches)
                this.hideMounted = false
                this.newValue = matches
                // setTimeout(() => {
                    //  this.users = matches
                // }, 3000);
                  
        }
    }
}
</script>


<style lang="scss" scoped>

.user-box {
    padding: 14px;
    text-align: center;
    background: linear-gradient(145deg,#fff,#e6e6e6);
    box-shadow: 15px 15px 30px #d9d9d9, -15px -15px 30px #fff;
    margin-bottom: 26px;
   
}
.user-box-link{
    text-decoration: none;
}
</style>