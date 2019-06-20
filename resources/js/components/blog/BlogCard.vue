<template>
  <!-- Blog Post -->
  <div class="col-12 col-lg-6">
    
    <div class="card mb-4">
      <router-link :to="{ name: 'blog.view', params: { 'slug': blog.slug } }">
        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
      </router-link>
      <div class="card-body">
        <h2 class="card-title">
          {{ blog.id }}
          <router-link :to="{ name: 'blog.view', params: { 'slug': blog.slug } }">
            {{ blog.title }}
          </router-link>
        </h2>
        <p class="card-text">
          {{ blog.intro }}
        </p>
        <router-link :to="{ name: 'blog.view', params: { 'slug': blog.slug } }">
          <button class="btn btn-primary">Read More &rarr;</button>
        </router-link>
      </div>
      <div class="card-footer text-muted">
        Posted on {{ blog.created_at }} by <a href="#">Start Bootstrap</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {

  },
  props: {
    blog: {
      type: Object,
      required: true, default: {}
    }
  },
  //   middleware: 'auth',
  data () {
    return {

    }
  },
  computed: {
    
  },
  watch: {

  },
  methods: {

  }
}
</script>

<style lang="sass" scoped>

</style>
