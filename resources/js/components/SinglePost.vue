<template>

    <div>
        <div class="card mt-4">
            <div class="card-body">
              <h5 class="card-title"> {{ post.title }} </h5>

              <p class="card-text">
                {{ cutText(post.content) }}
              </p>

              <router-link 

                class="btn btn-sm btn-primary"
                :to="{
                  name: 'post-details',
                  params: {slug: post.slug}
                }">View
              </router-link>

            </div>
        </div>
    </div>

</template>

<script>

    export default {
        name: "SinglePost",
        props: {
            post: Object
        },
        methods: {
            cutText(text) {
                if (text.length > 75) {
                    return text.slice(0, 50) + "..";
                } else {
                    return text;
                }
            },
        },
    }

</script>