<template>

  <section>
    <div class="container mt-4">
      <h1 class="text-center">{{ pageTitle }}</h1>

      <div class="row row-cols-3">
        <!-- Single post card -->
        <div v-for="post in posts" :key="post.id" class="col">
          <SinglePost :post="post"/>
        </div>
      </div>
    </div>

    <!-- Button for the previous page -->
    <div class="container mt-4">
     <ul class="pagination justify-content-center">
      <li>
        <a @click.prevent="getPosts(currentPage - 1)" 
          href="#" 
          type="button" 
          class="btn btn-primary" 
          :class="{'disabled' : currentPage == 1}">
          Previous
        </a>
     </li>

      <!-- Number of pages -->
      <li v-for="pageNumber in lastPage" :key="pageNumber" class="page-item" :class="{'active' : pageNumber == currentPage}">
        <a @click.prevent="getPosts(pageNumber)" class="page-link" href="#"> {{ pageNumber }} </a>
      </li>

      <!-- Button for the next page -->
      <li>
        <a @click.prevent="getPosts(currentPage + 1)" 
          href="#" 
          type="button" 
          class="btn btn-primary" 
          :class="{'disabled' : currentPage == lastPage}">
          Next
        </a>
      </li>
     </ul>
    </div>
  </section>

</template>

<script>

  import SinglePost from '../components/SinglePost.vue';

  export default {
    name: "Posts",
    components: { SinglePost },
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
    },
    mounted() {
      this.getPosts(this.currentPage);
    }
  };

</script>
  
