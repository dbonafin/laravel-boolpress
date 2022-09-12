<template>

  <section>
    <div class="container mt-4">
      <h1 class="text-center">{{ pageTitle }}</h1>

      <div class="row row-cols-3">
        <!-- Single post card -->
        <div v-for="post in posts" :key="post.id" class="col">
          <div class="card mt-4">
            <div class="card-body">
              <h5 class="card-title">{{ post.title }}</h5>
              <p class="card-text">
                {{ cutText(post.content) }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Button for the previous page -->
    <div class="container text-center mt-4">
      <a @click.prevent="getPosts(currentPage - 1)" 
        href="#" 
        type="button" 
        class="btn btn-primary" 
        :class="{'disabled' : currentPage == 1}">
        Previous
      </a>

      <!-- Button for the next page -->
      <a @click.prevent="getPosts(currentPage + 1)" 
        href="#" 
        type="button" 
        class="btn btn-primary" 
        :class="{'disabled' : currentPage == lastPage}">
        Next
      </a>
    </div>
  </section>

</template>

<script>

  export default {
    name: "Posts",
    data() {
      return {
        pageTitle: "Posts Feed",
        posts: [],
        currentPage: 1,
        lastPage: null
      };
    },
    methods: {
      getPosts(pageNumber) {
        axios.get('/api/posts', {
          params: {
            page: pageNumber
          }
        })
        .then((response) => {
          this.posts = response.data.results.data;
          this.currentPage = response.data.results.current_page;
          this.lastPage = response.data.results.last_page;
        });
      },
      cutText(text) {
        if (text.length > 75) {
          return text.slice(0, 50) + "..";
        } else {
          return text;
        }
      },
    },
    mounted() {
      this.getPosts(this.currentPage);
    }
  };

</script>
  
