<template>
    <main-layout :user="user" use-container>
    </main-layout>
</template>

<script>
import mainLayout from "../Layouts/mainLayout.vue";

export default {
    props: ["user","profile"],
    components: {
        mainLayout
    },
    metaInfo: {
        title: "Home"
    },
    data: () => ({
        user: false
    }),
    created() {
        console.log(this.user)
    },
    methods: {}
};
</script>

<style></style>
