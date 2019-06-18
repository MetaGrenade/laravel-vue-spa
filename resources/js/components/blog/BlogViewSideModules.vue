<template>
  <div class="col-md-4 col-lg-3 order-1 order-md-2">
    <!-- Side Widget -->
    <div class="card my-4">
      <h5 class="card-header">
        Author
      </h5>
      <div class="card-body">
        {{ author.name }}
      </div>
    </div>
    <!-- Side Widget -->
    <div class="card my-4">
      <h5 class="card-header">
        Side Widget
      </h5>
      <div class="card-body">
        You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
      </div>
    </div>
  </div>
</template>

<script>
import SearchModule from '../../components/modules/SearchModule.vue'
import CategoriesModule from '../../components/modules/CategoriesModule.vue'

export default {
  components: {
    SearchModule,
    CategoriesModule
  },
  props: 
    ['author', 'related_blogs', 'recently_posted_blogs']
  ,
  //   middleware: 'auth',
  data () {
    return {}
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
