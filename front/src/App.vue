<template>
  <div id="app">
    <img src="./assets/map.png" id = "map" z-index=0>
    <p class="data">Code | Clouds | Wind | Visibility | Temp | City</p>

    <place name="Charlottesville" code="KCHO" x=415 y=780></place>
    <place name="Bridgewater" code="KVBW" x=50 y=530></place>
    <place name="Weyers Cave" code="KSHD" x=200 y=590></place>
    <place name="Gordonsville" code="KGVE" x=650 y=730></place>
    <place name="Waynesboro" code="KW13" x=160 y=750></place>
    <place name="Washington" code="KIAD" x=1360 y=100></place>
    <!-- <img src="./assets/arrow.png"> -->
  </div>
</template>

<script>
import place from './components/place.vue'

export default {
  name: 'app',
  components: {
    place
  },
  data: function() {
    return {
        mapUrl: null,
    }
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
