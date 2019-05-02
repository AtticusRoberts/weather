<template>
  <div>
    <!-- Sometimes the API doesn't send me all the data for a station, which breaks everything if I don't handle that case with the v-if's -->
    <p class = "data">{{ code }} | <span v-if="weather.clouds[0]">{{ weather.clouds[0].type}}</span><span v-if="!weather.clouds[0]">N/A </span> | <span v-if="weather.wind_direction">{{weather.wind_direction.repr }}&deg; </span><span v-if="!weather.wind_direction">N\A </span><span v-if="weather.wind_speed">{{ weather.wind_speed.repr }} {{weather.units.wind_speed}} </span><span v-if="!weather.wind_speed">N\A</span> | <span v-if="weather.visibility">{{weather.visibility.repr}} {{weather.units.visibility}}</span><span v-if="!weather.visibility">N\A</span> | <span v-if="weather.temperature">{{weather.temperature.repr}}&deg; {{weather.units.temperature}}</span><span v-if="!weather.temperature">N\A</span> | {{name}}</p>
    <p class = "alert" v-bind:id = "x" v-if="weather.visibility.value<5"><strong>Low Visibility</strong></p>
    <p class = "label cloud" v-bind:id = "code" v-if="weather.clouds[0]">{{ name }}</p>
    <p class = "label" v-bind:id = "code" v-if="!weather.clouds[0]">{{name}}</p>
    <img src="../assets/arrow.png" class="arrow" v-bind:id = "name">
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'place',
  props: ['name','code','x','y'],
  data: function() {
    return {
        mapUrl: null,
        weather: {
          clouds: [
            {
              type: null
            }
          ],
          wind_direction: {
            repr: null
          },
          wind_speed: {
            repr: null
          },
          visibility: {
            value: 0
          },
          units: {
            wind_speed: null,
            visibility: null,
            temperature: null
          }
        }
    }
  },
  methods: {
    ping: function() {
      axios.post("http://localhost:8000/api/getWeather",this.$props).then(res => (
        this.weather = res.data,
        this.cloud(),
        this.wind()
      ));
    },
    cloud: function() {
      //There are sometimes more elements in the clouds array but I don't know what they mean so I just use the first one
      if (!this.weather.clouds[0]) {document.getElementById(this.code).style.background = "rgb(0,0,0,0)";}
      else if (this.weather.clouds[0].type == "FEW") {document.getElementById(this.code).style.background = "rgb(255,255,255)";document.getElementById(this.code).style.color = "black";}
      else if (this.weather.clouds[0].type == "SCT") {document.getElementById(this.code).style.background = "rgb(200,200,200)";document.getElementById(this.code).style.color = "black";}
      else if (this.weather.clouds[0].type == "BKN") {document.getElementById(this.code).style.background = "rgb(125,125,125)";document.getElementById(this.code).style.color = "white";}
      else if (this.weather.clouds[0].type == "OVC") {document.getElementById(this.code).style.background = "rgb(75,75,75)";document.getElementById(this.code).style.color = "white";}
      else if (this.weather.clouds[0].type == "VV") {document.getElementById(this.code).style.background = "rgb(25,25,25)";document.getElementById(this.code).style.color = "white";}
    },
    wind: function() {
      document.getElementById(this.name).style.transform = 'rotate('+this.weather.wind_direction.value+'deg)';
      document.getElementById(this.name).style.width = (this.weather.wind_speed.value*10+10)+"px";
    }
  },
  mounted() {
    this.ping();
    document.getElementById(this.code).style.top = this.y+"px";
    document.getElementById(this.code).style.left = this.x+"px";
    document.getElementById(this.x).style.top = this.y-13+"px";
    document.getElementById(this.x).style.left = this.x+"px";
    document.getElementById(this.name).style.top = parseInt(this.y)+75+"px";
    document.getElementById(this.name).style.left = parseInt(this.x)+"px";
    setInterval(function () {
      this.ping();
    }.bind(this),30000);
  }
}

</script>
