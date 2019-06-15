<template>
  <!-- Blog Post -->
  <div class="card mb-4">
    <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
    <div class="card-body">
      <h2 class="card-title">
        {{ blog.id }}
        {{ blog.title }}
      </h2>
      <p class="card-text">
        {{ blog.intro }}
      </p>
      <a href="#" class="btn btn-primary">Read More &rarr;</a>
    </div>
    <div class="card-footer text-muted">
      Posted on {{ blog.created_at }} by <a href="#">Start Bootstrap</a>
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
