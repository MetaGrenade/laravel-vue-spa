<template>
  <div class="col-md-4 order-1 order-md-2">
    <!-- Search Widget -->
    <SearchModule :model="'Blog'" />

    <!-- Categories Widget -->
    <CategoriesModule :categories="categories" />

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
  props: {

  },
  //   middleware: 'auth',
  data () {
    return {
      categories: [
        { 
          name: 'Cat One', 
          url: '#' 
        },
        { 
          name: 'Cat Two', 
          url: '#' 
        },
        { 
          name: 'Cat Three', 
          url: '#' 
          },
        { 
          name: 'Cat Four', 
          url: '#' 
        },
        { 
          name: 'Cat Five', 
          url: '#' 
        },
        { 
          name: 'Cat Six', 
          url: '#' 
        }
      ]
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
