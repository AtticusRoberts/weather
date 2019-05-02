<template>
  <div id="app">
    <img src="./assets/map.png" id = "map" z-index=0>
    <p class="data">Code | Clouds | Wind | Visibility | Temp | City</p>
    <place v-for="(s, index) in stations" v-bind:name="stations[index].City" v-bind:code="stations[index].Station" v-bind:x="coordinates[index].x" v-bind:y="coordinates[index].y"></place>
  </div>
</template>

<script>
import place from './components/place.vue'
import axios from 'axios'
export default {
  name: 'app',
  components: {
    place
  },
  data: function() {
    return {
        mapUrl: null,
        stations: {

        },
        coordinates: [
          {x: 415, y: 800},
          {x: 50, y: 550},
          {x: 200, y: 610},
          {x: 650, y: 750},
          {x: 160, y: 770},
          {x: 1360, y: 100}
        ]
    }
  },
  mounted() {
    axios.post("http://localhost:8000/api/getAllWeather").then(res => (
      this.stations = res.data
    ));
  }
}

</script>

<style>
body {
  font-family: sans;
}
#map {
  width: 1892px;
}
#KIAD {
  font-size: 35px;
}
.data {
  position: relative;
  top: -950px;
  left: 5px;
  display: inline;
  background-color: white;
  padding-right: 5px;
  padding-left: 5px;
}
.label {
  position: absolute;
  padding: 5px;
  font-family: sans;
  font-size: 25px;
  z-index: 1;
}
.cloud {
  background-color: rgb(255,255,255);
  opacity: 0.75;
}
.arrow {
  position: absolute;
  width: 100px;
  z-index: 2;
}
.button-label {
  display: inline;
}
.alert {
  position: absolute;
  background-color: red;
  color: yellow;
  padding: 2px;
}
</style>
