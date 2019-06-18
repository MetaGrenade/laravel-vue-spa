<template>
	<div class="row px-2">
		<!-- Blog Entries Column -->
		<div class="col-md-8 col-lg-9 order-2 order-md-1">
			<h1 class="my-4">
				{{ blog.title }}
			</h1>

			<div class="row">
				<!-- Blog Post -->
				<div class="col-12">
					{{ blog.content }}
				</div>
			</div>
		</div>

		<!-- Sidebar Widgets Column -->
		<BlogViewSideModules />
	</div>
</template>

<script>
// import { mapState } from 'vuex'
import axios from 'axios'

import BlogViewSideModules from '../components/blog/BlogViewSideModules.vue'

export default {
	components: {
		BlogViewSideModules
	},
	props: {

	},
	//   middleware: 'auth',
	data () {
		return {
            blog: {},
            blog_categories: []
        }
	},
	metaInfo () {
		return { 
			title: this.$t('home') 
		}
	},
	// computed: mapState([
	// 	'blog'
	// ]),
	// mounted() {
	// 	this.$store.dispatch('blogs/fetchBlog')
    // },
    created() {
		// Fill the form with blog data from API or STORE.
		this.getBlog()
    },
	methods: {
        getBlog: async function() {
			// get blog data from store or api ?
			await axios.get('/api/blogs/' + this.$route.params.id)
				.then(response => {
					// console.log(response)
					this.blog = response.data.blog
					this.blog_categories = response.data.blog_categories
					// console.log(this.form)
				});
		},
	},
	watch: {

	},
}
</script>

<style lang="scss" scoped>

</style>
