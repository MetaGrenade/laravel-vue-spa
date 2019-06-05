<template>
  <div class="card my-4">
    <h5 class="card-header">
      Search
    </h5>
    <div class="card-body">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for...">
        <span class="input-group-btn">
          <button class="btn btn-secondary" type="button">Go!</button>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {

  },
  props: {
    model: {
      type: String,
      required: true, 
      default: null
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
