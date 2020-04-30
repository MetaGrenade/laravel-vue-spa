<template>
	<div class="row px-2">
		<!-- Blog Entries Column -->
		<div class="col-md-8 col-lg-9 order-2 order-md-1">
			<h1 class="my-4">
				{{ $t('blog') }}
				<small>{{ $t('blog_welcome') }}</small>
			</h1>

			<div class="row">
				<!-- Blog Post -->
				<BlogCard v-for="(blog, index) in blogs.blogs" :key="index" :blog="blog" />
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
		<BlogSideModules :blog_categories="blogs.blog_categories"/>
	</div>
</template>

<script>
import { mapState } from 'vuex'

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
		return {}
	},
	metaInfo () {
		return { 
			title: this.$t('home') 
		}
	},
	computed: mapState([
		'blogs'
	]),
	mounted() {
		this.$store.dispatch('blogs/fetchPublishedBlogs')
	},
	methods: {

	},
	watch: {

	},
}
</script>

<style lang="scss" scoped>
	@import "node_modules/bootstrap/scss/functions";
	@import "node_modules/bootstrap/scss/variables";
	@import "node_modules/bootstrap/scss/mixins/_breakpoints";

	.card-columns {
		@include media-breakpoint-only(lg) {
			column-count: 2;
		}
		@include media-breakpoint-only(xl) {
			column-count: 3;
		}
	}
</style>
