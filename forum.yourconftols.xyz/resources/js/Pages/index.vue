<template>
  <main-layout class="home">
    <div class="container">
      INDEX
    </div>
  </main-layout>
</template>

<script>
import mainLayout from "../Layouts/mainLayout.vue"

export default {
  components: {
    mainLayout
  },
  metaInfo: {
    title: 'Home'
  },
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
