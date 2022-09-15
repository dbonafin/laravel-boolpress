<template>

    <div v-if="post">
        <div class="card mb-3">

            <img class="w-50 mx-auto mt-4 card-img-top" v-if="post.cover" :src="post.cover" :alt="post.title"/>

            <div class="card-body">
                <h5 class="card-title text-center">{{post.title}} </h5>
                <p class="card-text text-center">
                    {{post.content}}
                </p>

                <div class="text-center" v-if="post.category">Category: {{post.category.name}}</div>

                <div 
                    class="text-center" 
                    v-if="post.tags.length > 0"> 
                    <span v-for="tag in post.tags" 
                    :key="tag.id" 
                    class="badge bg-info text-dark ml-2"
                >
                        {{tag.name}}
                    </span>
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