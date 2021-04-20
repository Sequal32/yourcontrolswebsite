<template>
    <member-layout :user="user">
        This is under heavy development. Any suggestions would be nice. You can send them <inertia-link href="/member-area/suggestions/submit">here</inertia-link>
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
    created() {
        this.user.roles_JSON = JSON.parse(this.user.roles_JSON)
    },
    methods: {}
};
</script>

<style></style>
