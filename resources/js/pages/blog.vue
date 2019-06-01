<template>
  <div class="row px-2">
    <!-- Blog Entries Column -->
    <div class="col-md-8 order-2 order-md-1">
      <h1 class="my-4">
        {{ $t('blog') }}
        <small>{{ $t('blog_welcome') }}</small>
      </h1>

      <div class="row">
        <!-- Blog Post -->
        <BlogCard v-for="(blog, index) in blogs" :key="index" :blog="blog" />
      </div>

      <!-- Pagination -->
      <ul class="pagination justify-content-center mb-4">
        <li class="page-item">
          <a class="page-link" href="#">&larr; Older</a>
        </li>
        <li class="page-item disabled">
          <a class="page-link" href="#">Newer &rarr;</a>
        </li>
      </ul>
    </div>

    <!-- Sidebar Widgets Column -->
    <BlogSideModules />
  </div>
</template>

<script>
import BlogCard from '../components/blog/BlogCard.vue'
import BlogSideModules from '../components/blog/BlogSideModules.vue'

export default {
  components: {
    BlogCard,
    BlogSideModules
  },
  props: {

  },
  //   middleware: 'auth',
  data () {
    return {
      blogs: [
        {
          title: 'Title 1',
          body: 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum '
        },
        {
          title: 'Title 2',
          body: 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum '
        }
      ]
    }
  },
  metaInfo () {
    return { title: this.$t('home') }
  },
  computed: {

  },
  watch: {

  },
  methods: {

  }
}
</script>
