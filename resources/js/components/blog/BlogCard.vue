<template>
  <!-- Blog Post -->
  <div class="col-12 col-xl-6">
    <div class="card mb-4">
      <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
      <div class="card-body">
        <h2 class="card-title">
          {{ blog.title }}
        </h2>
        <p class="card-text">
          {{ blog.body }}
        </p>
        <a href="#" class="btn btn-primary">Read More &rarr;</a>
      </div>
      <div class="card-footer text-muted">
        Posted on January 1, 2017 by
        <a href="#">Start Bootstrap</a>
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
