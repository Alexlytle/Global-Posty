
import '../js/bootstrap'
import { createApp } from 'vue';
import LaravelVuePagination from 'laravel-vue-pagination';
import Chatapp from '../components/Chatapp'

import Conversation from '../components/Conversation'
import Contactlist from '../components/Contactlist'
import Country from '../components/Country'
import Messagecomposer from '../components/Messagecomposer'
import Messagesfeed from '../components/Messagesfeed'

import Search from '../components/Search'

let app = createApp({});



app.component('Chatapp',Chatapp)
app.component('Contactlist',Contactlist)
app.component('Conversation',Conversation)
app.component('Country',Country)
app.component('Messagesfeed',Messagesfeed)
app.component('Messagecomposer',Messagecomposer)

app.component('Search',Search)

app.mount('#app')