<template>
  <main-layout use-container>
    <div v-for="changelog in changelogArray" :key="changelog.id" class="changelog">
      <h1 class="title"> {{ changelog.version }} </h1>
      <div class="changelog-body" v-html="changelog.body"></div>
    </div>
  </main-layout>
</template>

<script>
import mainLayout from "../Layouts/mainLayout.vue"
import axios from "axios"
import marked from "marked"

export default {
  components: {
    mainLayout
  },
  metaInfo: {
    title: 'Change Log'
  },
  data: () => ({
    changelogArray: []
  }),
  created() {
    axios.get("https://api.github.com/repos/Sequal32/yourcontrols/releases")
    .then(r => {
      for (let i = 0; i < r.data.length; i++) {
        if (!r.data[i].prerelease) {
          let changelog = {}
          changelog.id = r.data[i].id;
          changelog.version = r.data[i].tag_name;
          changelog.body = marked(r.data[i].body);
          this.changelogArray.push(changelog)
        }
      }
    })
  },
}
</script>

<style lang="scss" scoped>
.changelog {
  margin: 50px 15px;
  color: #000;
  position: relative;
  .title{
    margin-bottom: 10px;
    color: #000;
  }
  &::after{
    content:"";
    position: absolute;
    bottom: -25px;
    left: 0;
    right: 0;
    height: 0.5em;
    width: 100%;
    border-top: 1px solid #00404c;
  }
}
</style>

<style lang="scss">
.changelog-body{
    a {
      color: #000;
    }
    h1 {
      margin: 15px 0px;
      color: #000;
    }
    h2 {
      margin: 15px 0px;
      color: #000;
    }
    ul {
      li {
        margin-left: 30px;
      }
    }
  }
</style>
