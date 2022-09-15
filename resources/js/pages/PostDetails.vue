<template>

    <div v-if="post">
        <div class="card text-dark text-center bg-light mb-3">
            <div class="card-header"> {{post.title}} </div>


            <div class="card-body">
                <p class="card-text"> {{post.content}} </p>

                <div v-if="post.category">Category: {{post.category.name}}</div>

                <div v-if="post.tags.length > 0"> 
                    <span v-for="tag in post.tags" :key="tag.id" class="badge bg-info text-dark ml-2">{{tag.name}}</span>
                </div>
               
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