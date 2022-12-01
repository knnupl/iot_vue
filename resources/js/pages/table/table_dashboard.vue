<template>
  <v-table>
    <thead>
      <tr>
        <th style="border: 1px solid black;" class="text-left">
          Name
        </th>
        <th style="border: 1px solid black;" class="text-left">
          Calories
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(item,ind) in values"
        :key="ind"
      >
        <td style="border: 1px solid lightgray;">{{ item.device }}</td>
        
        <td style="border: 1px solid lightgray;" v-if="index=== 0">{{ item.value }}</td>
        <td style="border: 1px solid lightgray;" v-if="index=== 1">      
          <v-switch v-model="item.is_active" color="primary" v-on:click="submit(ind)"> </v-switch>
        </td>
      </tr>
    </tbody>
  </v-table>
  </template>
  <script>
  export default {
    props:['values','index'],
    data () {
      return {         
    
    data:null,
      }
    },
    methods: {
      submit(ind){
        console.log(ind);
        console.log(this.data);
        axios.post('api/outputdata',{                     
                      id: ind+1,
                      is_active : !this.values[ind].is_active
                  })
                    .then((response) =>{
                  
                        // handle success.
                        console.log(response.data);                         
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

<style>

</style>