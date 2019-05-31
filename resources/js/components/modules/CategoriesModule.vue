<template>
	<div class="card my-4">
		<h5 class="card-header">Categories</h5>
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-lg-6" v-for="(category, index) in categories" :key="index">
					<a href="#">{{ category.name }}</a>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
//   middleware: 'auth',
	data () {
		return {

		}
	},
	props: {
		// which model are we searching?
		categories: Array
	},
	components: {

	},
	computed: {

	},
	methods: {

	},
	watch: {

	}
}
</script>

<style lang="sass" scoped>

</style>
