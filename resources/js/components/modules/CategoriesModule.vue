<template>
  <div class="card my-4">
    <h5 class="card-header">
      Categories
    </h5>
    <div class="card-body">
      <div class="row">
        <ul>
          <li v-for="(category, index) in blog_categories" :key="index">
            <a href="#">{{ category.title }}</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {

  },
  props: ['blog_categories'],
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
