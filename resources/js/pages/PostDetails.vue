<template>

    <div v-if="post">
        <div class="card text-dark text-center bg-light mb-3">
            <div class="card-header"> {{post.title}} </div>

            <div class="card-body">
                <p class="card-text"> {{post.content}} </p>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "PostDetails",
        data() {
            return {
                post: null,
            }
        },
        methods: {
            getSinglePost() {
                axios.get(`/api/posts/${this.$route.params.slug}`)
                .then((response) => {
                    this.post = response.data.results;
                })
                // .catch((error)=> {
                //     console.log(error);
                // });
            }
        },
        mounted() {
            this.getSinglePost();
        },
    }

</script>