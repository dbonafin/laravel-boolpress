<template>

    <div>
        <h2>This is the blog page</h2>

        <Posts/>
    </div>

</template>

<script>

    import Posts from "../components/Posts.vue";

    export default {
        name: "BlogPage",
        components: { Posts }
    }

</script>