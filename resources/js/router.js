import Vue from 'vue';
import VueRouter from 'vue-router';

// Import the page-components
import HomePage from "./pages/HomePage.vue";
import AboutPage from "./pages/AboutPage.vue";
import BlogPage from "./pages/BlogPage.vue";
import NotfoundPage from "./pages/NotfoundPage.vue";
import PostDetails from "./pages/PostDetails.vue";
import ContactPage from "./pages/ContactPage.vue";

Vue.use(VueRouter);

// Create a route foreach page-component
const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', 
        component: HomePage,
        name: 'home' 
        },
        { path: '/about', 
        component: AboutPage,
        name: 'about' 
        },
        { path: '/blog', 
        component: BlogPage,
        name: 'blog' 
        },
        { path: '/blog/:slug', 
        component: PostDetails,
        name: 'post-details' 
        },
        {
         path: '/contact',
         name: 'contact',
         component: ContactPage
        },
        { path: '/*', 
        component: NotfoundPage,
        name: 'not-found' 
        }
    ]
});

export default router;