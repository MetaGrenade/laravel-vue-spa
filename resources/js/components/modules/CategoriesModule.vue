<template>
  <div class="card my-4">
    <h5 class="card-header">
      Categories
    </h5>
    <div class="card-body">
      <div class="row">
        <div v-for="(category, index) in categories" :key="index" class="col-12 col-lg-6">
          <a href="#">{{ category.name }}</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {

  },
  props: {
    categories: {
      type: Array,
      required: true
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
