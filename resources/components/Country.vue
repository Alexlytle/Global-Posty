<template>
<div class="row" style="margin:0">

    <div  class="col-md-12 col-form-label text-md-right spinner-col" >
             <div class="spinner-wrapper" v-show ='showspinner'>
                <div class = 'spinner-loader'></div>
             </div>
            </div>
</div>
      <div class="row mb-3" >
        <div  class="col-md-4 col-form-label text-end"> 
            Country name
          </div>
      
          <div class="col-md-3" >
        
              <input autocomplete="new-password" placeholder="Country name" type="text" v-on:keyup = 'handleInput($event)'  v-model="country" class="form-control">
           
          </div>
    
            <div class="col-md-3">
         
                                    <select  size="3"
                                        v-if="finalCountryResult.length !== 0 && country !== '' " 
                                        name="country"    
                                        v-model="finalCountryVal"                       
                                        @change="handleCountryChange"
                                        class="form-control" id="exampleFormControlSelect1">
                                        
                                         
                                            <option  v-for="(country,index) in finalCountryResult" :value="country.name" :key="index" :selected="country.value">
                                            
                                                  {{country.value}}
                                            </option>
                                </select>
                                <small  v-if="finalCountryResult.length !== 0 && country !== '' ">Please select country</small>
              </div>
           
        </div>
    

                            <div class=" row mb-3">
                                <label 
                                 v-if="finalCountryResult.length !== 0 && country !== ''"
                                 for="zip-code" 
                                 class="col-md-4 col-form-label text-end">
                                    Zip Code / Postal code
                                </label>
                                <div class="col-md-6">
                                    <input 
                                    placeholder="Zip/Postal Code"
                                    autocomplete="new-password" 
                                    v-model="zip" 
                                    v-on:keyup = 'handleInputCountry($event)'  
                                    type="zip-code"
                                    v-if="finalCountryResult.length !== 0 && country !== '' "
                                     name="zipcode" class="form-control">
                                     
                                    <div v-if="finalCountryResult.length !== 0 && country !== '' && zip !== ''">
                                            <div class="tabs"  v-if = "search == true " >
                                                <div class="tabs__nav">
                                                <div class="tabs__nav_tab"
                                                    v-for="(item, index) in places"
                                                    :key="index"
                                                    :class="[index === active ? 'tabs__nav_tab--active' : '']"
                                                    @click="activate(index)">{{item['place name']}}</div>
                                                </div>
                                                <div class="tabs__content">
                                                   
                                                       <p>
                                                         City: <input readonly type="text" name="placename" :value="content['place name']" >    
                                                       </p>
                                                      <p>
                                                        State: <input  readonly type="text" name="state" :value="content['state']" >   
                                                      </p>
                                                      
                                                </div>
                                            </div>

                                    </div>
                               
                                </div>
                                <!-- {{places.length}} -->
                                <!-- <div v-if="zip !== '' && country !== '' " @click="getCountries"  class ="btn btn-secondary d-flex align-items-center">
                                    <small>Search</small>
                                </div> -->
                       
                          
                            </div>
</template>

<script>
export default {

    data(){
        return{
            finalCountryVal:'',
            country:'',
            zip:'',
            places:[],
            activePlace:false,
              active: 0,
            search:false,
            countries:[
                {name:'AD',value:'Andorra'},
                {name:'AR',value:'American Samoa'},
                {name:'AT',value:'Austria'},
                {name:'AU',value:'Australia'},
                {name:'BD',value:'Bangladesh'},
                {name:'BE',value:'Belgium'},
                {name:'BG',value:'Bulgaria'},
                {name:'CA',value:'Canada'},
                {name:'CH',value:'Switzerland'},
                {name:'CZ',value:'Czech Republic'},
                {name:'DE',value:'Germany'},
                {name:'DK',value:'Denmark'}, 
                {name:'DO',value:'Dominican Republic'},
                {name:'ES',value:'Spain'},
                {name:'FI',value:'Finland'},
                {name:'FO',value:'Faroe Islands'},
                {name:'FR',value:'France'},
                {name:'GB',value:'Great Britain'},
                {name:'GF',value:'French Guyana'},
                {name:'GG',value:'Guernsey'},
                {name:'GL',value:'Greenland'},
                {name:'GP',value:'Guadeloupe'},
                {name:'GT',value:'Guatemala'},
                {name:'GU',value:'Guam'}, 
                {name:'HR',value:'Croatia'},
                {name:'HU',value:'Hungary'},
                {name:'IM',value:'Isle of Man'},
                {name:'IN',value:'India'},
                {name:'IS',value:'Iceland'},
                {name:'IT',value:'Italy'},
                {name:'JE',value:'Jersey'},
                {name:'JP',value:'Japan'},
                {name:'LI',value:'Liechtenstein'},
                {name:'LK',value:'Sri Lanka'},
                {name:'LT',value:'Lithuania'},
                {name:'LU',value:'Luxembourg'}, 
                {name:'MC',value:'Monaco'},
                {name:'MD',value:'Moldavia'},
                {name:'MH',value:'Marshall Islands'},
                {name:'MK',value:'Macedonia'},
                {name:'MP',value:'Northern Mariana Islands'},
                {name:'MQ',value:'Martinique'},
                {name:'MX',value:'Mexico'},
                {name:'MY',value:'Malaysia'},
                {name:'NL',value:'Norway'},
                {name:'NZ',value:'New Zealand'},
                {name:'PH',value:'Phillippines'},
                {name:'PK',value:'Pakistan'}, 
                {name:'PL',value:'Poland'},
                {name:'PM',value:'Saint Pierre and Miquelon'},
                {name:'PR',value:'Puerto Rico'},
                {name:'PT',value:'Portugal'},
                {name:'RE',value:'French Reunion'},
                {name:'RU',value:'Russia'},
                {name:'SE',value:'Sweden'},
                {name:'SI',value:'Slovenia'},
                {name:'SK',value:'Slovak Republic'},
                {name:'SM',value:'San Marino'},
                {name:'TH',value:'Thailand'}, 
                {name:'TR',value:'Turkey'},
                {name:'US',value:'United States'},
                {name:'VA',value:'Vatican'}, 
                {name:'VI',value:'Virgin Islands'},
                {name:'YT',value:'Mayotte'},
                {name:'ZA',value:'South Africa'}, 
            ],
            previous:'',
            typingtime:'',
            showspinner:false,
            finalCountryResult:[]
        }
    },
      computed: {
    content () {
      return this.places[this.active]
    }
  },
    methods:{
      handleInputCountry(e){
            console.log(e)
                   if( e.target.value != this.previous ){
                      clearTimeout(this.typingtimer)
                  if(e.target.value !== ''){
                      if(this.showspinner == false){
                          this.showspinner = true
                          this.results  = ''
                        }
                      this.typingtimer =  setTimeout(()=>{

                        this.showspinner = false
                        this.getCountries(e.target.value)

                      },500)
                  }else{
                    
                  
                    console.log(this.zip)
                    this.showspinner = false
                    this.results  = ''
                  }
              }
              this.previous = e.target.value
      },
      handleInput(e){
      
              if( e.target.value != this.previous ){
                      clearTimeout(this.typingtimer)
                  if(e.target.value !== ''){
                      if(this.showspinner == false){
                          this.showspinner = true
                          this.results  = ''
                        }
                          this.typingtimer =  setTimeout(()=>{
                            
                            this.showspinner = false
                            this.findCountry(e.target.value)

                          },500)
                  }else{
                this.zip = ''
                    this.showspinner = false
                    this.results  = ''

                  }
              }
              this.previous = e.target.value
        },
        findCountry(search){

          console.log(search)
          this.finalCountryResult = this.countries.filter((country)=>{
                const regex = new RegExp(`^${search.toLowerCase()}`, 'gi');
                return country.value.toLowerCase().match(regex);
          })
    
           this.finalCountryVal = this.finalCountryResult[0].name
      
        },
           activate (index) {
            this.active = index
            },
        getCountries(val){

              fetch(`https://api.zippopotam.us/${this.finalCountryVal.toLowerCase()}/${val}`)
                .then(res=>res.json())
                .then(data=>{
                        this.places = data.places
                        console.log(this.places)
                        this.search = true
                })
        },
        handleCountryChange(){
              this.zip = ''
               this.places = []
        },
        handleZipChange(){
          
            if(this.zip.length == 0){
                this.zip = ''
               this.places = []
            }
        }
       
    }
}
</script>

<style lang="scss" scoped>
.spinner-col{
      height: 20px;
    padding: 0;
    margin-bottom: 2px;
}
.spinner-wrapper{
  display: flex;
  justify-content: center;
}
    .places-box{
            background: #007bff;
            padding: 9px;
            color: white;
            margin-top: 10px;
            text-align: center;
            cursor: pointer;
     
                p{
                    margin: 0;
                }
    }

           .active{
                border:2px solid red;
            }

            .tabs {

 
  background:#e8f0fe;
  padding:1rem;
  &__nav {
    display:flex;
    &_tab {
      padding:1rem;
      margin:0 0.5rem 0 0;
      background:#fff;

      border-radius:0.5rem 0.5rem 0 0;
      box-shadow:inset 0 -1rem 0.75rem -1rem rgba(0,0,0,0.25);
      cursor:pointer;
      opacity:0.75;
      transition:100ms linear all;
    
      &--active {
        opacity:1;
        box-shadow:none;
      }
    }
  }
  &__content {
    background:#fff;
    padding:1rem;
    border-radius:0 0.5rem 0.5rem 0.5rem;
  }


}
.tabs__content{
  p{
    margin: 0;
  }
    input{
         border: none;
    }
}
@-webkit-keyframes spin{
  0%{transform:rotate(0deg)
  }
  to
  {transform:rotate(1turn)}
}

@keyframes
spin{0%
  { transform:rotate(0deg)
   }
  to
  {transform:rotate(1turn)}
}
.spinner-loader{
 
  border-radius:50%;
  width:14px;
  height:14px;
  border:.25rem solid rgba(0,0,0,.2);
  border-top-color:#000;
  -webkit-animation:spin 1s linear infinite;
  animation:spin 1s linear infinite
}
</style>>

        <!-- <option value="AD">Andorra</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AT">Austria</option>
                                        <option value="AU">Australia</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BR">Brazil</option>
                                        <option value="CA">Canada</option>
                                        <option value="CH">Switzerland	</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DE">Germany</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="ES">Spain</option>
                                        <option value="FI">Finland</option>


                                        <option value="FO">Faroe Islands</option>
                                        <option value="FR">France</option>
                                        <option value="GB">Great Britain</option>
                                        <option value="GF">French Guyana</option>
                                        <option value="GG">Guernsey</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GU">Guam</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HR">Croatia	</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IM">Isle of Man</option>
                                        <option value="IN">India</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IT">Italy</option>
                                        <option value="JE">Jersey</option>


                                        <option value="JP">Japan</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MD">Moldavia</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MK">Macedonia</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="MQ">Martinique	</option>
                                        <option value="MX">Mexico</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="NL">Norway</option>
                                        <option value="NO">Norway</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="PH">Phillippines</option>


                                        <option value="PK">Pakistan</option>
                                        <option value="PL">Poland</option>
                                        <option value="PM">Saint Pierre and Miquelon</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="PT">Portugal</option>
                                        <option value="RE">French Reunion</option>
                                        <option value="RU">Russia</option>
                                        <option value="SE">Sweden</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SJ">Svalbard & Jan Mayen Islands</option>
                                        <option value="SK">Slovak Republic	</option>
                                        <option value="SM">San Marino</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TR">Turkey</option>
                                        <option value="US">United States</option>
                                        <option value="VA">Vatican</option>
                                        <option value="VI">Virgin Islands</option>

                                        <option value="YT">Mayotte</option>
                                        <option value="ZA">South Africa</option> -->

