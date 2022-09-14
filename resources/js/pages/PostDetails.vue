<template>

    <div v-if="post">
        <h2>{{post.title}} </h2>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. A ab corporis numquam? Veritatis tempore et vitae amet illum quidem consequatur ullam a. Iure impedit nisi possimus aliquid id vitae molestiae?
        </p>
    </div>

</template>

<script>
    
    import axios from 'axios';

    export default {
        name: "PostDetails",
        data() {
            return {
                post: null,
            }
        },
        methods: {
            getSinglePost() {
                axios.get('/api/posts' + this.$route.params.slug).then((response)=> {
                    this.post = response.data.results;
                });
            }
        },
        mounted() {
            this.getSinglePost;
        },
    }

</script>