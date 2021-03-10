<template>
    <member-layout :user="user">
        This is under heavy development. Any suggestions would be nice. You can send them in #suggestions and tagging @WebDev or @SafeShows#2002
    </member-layout>
</template>

<script>
import memberLayout from "../../Layouts/memberLayout.vue";
import axios from "axios";

export default {
    props: ["user"],
    components: {
        memberLayout
    },
    metaInfo: {
        title: "Home"
    },
    data: () => ({}),

    methods: {}
};
</script>

<style></style>
