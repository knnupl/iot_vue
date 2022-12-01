<template>
    <v-app :theme="theme">
      <v-app-bar>
        <v-spacer></v-spacer>
  
        <v-btn
          :prepend-icon="theme === 'light' ? 'mdi-weather-sunny' : 'mdi-weather-night'"
          @click="onClick"
        >Toggle Theme</v-btn>
      </v-app-bar>
  
      <v-main>
        <v-container>
          <v-card>  
            <v-tabs
              v-model="tab" background-color="deep-purple accent-4" centered dark icons-and-tex>
              <v-tabs-slider></v-tabs-slider>        
              <v-tab href="#tab-1">
                Input           
              </v-tab>
        
              <v-tab href="#tab-2">
                Output               
              </v-tab>       
            </v-tabs>
        
            <v-tabs-items v-model="tab">
              <v-tab-item>
                <v-card flat>
                  <v-sheet class="pa-2 ma-2">          
                    <tableDashboard :values="data[tab]" :index ="tab"></tableDashboard>                  
                </v-sheet>
                </v-card>
              </v-tab-item>

            </v-tabs-items>   
          </v-card>
        </v-container>
      </v-main>
    </v-app>
  </template>
  
  <script setup>
    import { ref } from 'vue'

    const theme = ref('light')
  
    function onClick () {
      theme.value = theme.value === 'light' ? 'dark' : 'light'
    }
  </script>

  <script>
  import tableDashboard from '../pages/table/table_dashboard.vue'
  export default {

    data() {
      return {
        data:[],        
        tab:null,   
      
      }
    },
    created() {
      this.GetData();
   
    },
    mounted() {
     this.set_Interval();
    },
    methods: {
      set_Interval: function(){
        console.log('Interval');
        window.setInterval( ()=>{this.GetData()}, 2000);
      
      },
      GetData(){        
        axios.get('api/getData/query')
                    .then((response) =>{
                      
                            // handle success.
                            console.log(response.data);
                            this.data[0]= response.data[0];
                            this.data[1] = response.data[1];
                           
                            return  response.data;                         
                    
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })
                        .then(function () {
                            // always executed
                        });
      },  
    },

 
  }
  
  </script>