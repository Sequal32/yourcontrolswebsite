<template>
  <main-layout class="home">
    <div class="container">
      <br>
      <br>
      <h2 class="text-center d-block d-md-block d-lg-none"><img src="/images/logo.png" alt="YourControls" class="logo d-inline-block align-top" width="100%" loading="lazy"></h2>
      <h2 class="text-center d-none d-md-none d-lg-block"><img src="/images/logo.png" alt="YourControls" class="logo d-inline-block align-top" height="100" loading="lazy"></h2>
      <br>
      <br>
      <div style="font-size: 17px;">
        YourControls is a program that allows multiple people to connect their simulators into a single shared flight deck. It allows tasks to be distributed among crewmates, where one can fly the aircraft, while another handles the radios and autopilot. Doing flights on VATSIM has never been more immersive. We’re striving to sync every switch and button in as many aircraft as possible, with support for the A32NX and in the future, other mods.
      </div>
    </div>
    <!-- <div class="container">
      <br>
      <br>
      <h2>Stats</h2>
      <div class="row">
        <div class="col" style="padding:20px"> {{count.installs}} Total Downloads</div>
        <div class="col" style="padding:20px"></div>
        <div class="col" style="padding:20px"></div>
      </div>
    </div> -->
    <div class="container">
      <br>
      <br>
      <h2>Features</h2>
      <div class="row justify-content-center">
        <div class="col-12 col-lg-4">
          <div class="card" style="min-height:200px; margin:5px">
            <div class="card-body">
              <h3 class="card-title">Easy to set up</h3>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium nulla vel odit eos perferendis porro fuga. Vel impedit asperiores a, tempore eum, culpa quasi iste sunt molestiae debitis blanditiis ullam?</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-4">
          <div class="card" style="min-height:200px; margin:5px">
            <div class="card-body">
              <h3 class="card-title">Lightweight</h3>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium nulla vel odit eos perferendis porro fuga. Vel impedit asperiores a, tempore eum, culpa quasi iste sunt molestiae debitis blanditiis ullam?</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-4">
          <div class="card" style="min-height:200px; margin:5px">
            <div class="card-body">
              <h3 class="card-title">Transferring controls</h3>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium nulla vel odit eos perferendis porro fuga. Vel impedit asperiores a, tempore eum, culpa quasi iste sunt molestiae debitis blanditiis ullam?</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-4">
          <div class="card" style="min-height:200px; margin:5px">
            <div class="card-body">
              <h3 class="card-title">Observer mode</h3>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium nulla vel odit eos perferendis porro fuga. Vel impedit asperiores a, tempore eum, culpa quasi iste sunt molestiae debitis blanditiis ullam?</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-4">
          <div class="card" style="min-height:200px; margin:5px">
            <div class="card-body">
              <h3 class="card-title">Smooth experience</h3>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium nulla vel odit eos perferendis porro fuga. Vel impedit asperiores a, tempore eum, culpa quasi iste sunt molestiae debitis blanditiis ullam?</p>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
    </div>
  </main-layout>
</template>

<script>
import mainLayout from "../Layouts/mainLayout.vue"
import axios from "axios"

export default {
  components: {
    mainLayout
  },
  metaInfo: {
    title: 'Home'
  },
  data: () => ({
    count:{
      installs: 0
    }
  }),
  created() {
    axios.get("https://api.github.com/repos/Sequal32/yourcontrolsinstaller/releases")
    .then(r => {
      for (let i = 0; i < r.data.length; i++) {
        if (!r.data[i].prerelease) {
          this.count.installs += r.data[i].assets[0].download_count
        }
      }
    })
  }
}
</script>

<style lang="scss" scoped>
.home {
  color: #000;
  ul {
    li {
      margin-left: 30px;
    }
  }
}
</style>
