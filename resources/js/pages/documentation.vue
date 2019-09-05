<template>
	<div class="row px-2">
		<!-- Blog Entries Column -->
		<div class="col-md-8 col-lg-9 order-2 order-md-1">
			<h1 class="text-orange my-4"><fa :icon="'book'" fixed-width/> {{ $t('documentation') }}</h1>

			<div class="row">
				<div class="col-12">
					<p>{{ $t('documentation_welcome') }}</p>
				</div>
				<div class="col-12">
					<h3 id="1">Getting Started</h3>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse nisi rem exercitationem quidem eum repudiandae! Laborum repudiandae totam accusantium eum nam, incidunt at quae provident id. Soluta porro inventore adipisci!</p>

					<h5 id="1-1">Requirements</h5>
					<ol>
						<li>Composer</li>
						<li>Node.js</li>
						<li>PHP >= 7.1.3</li>
						<li>BCMath PHP Extension</li>
						<li>Ctype PHP Extension</li>
						<li>JSON PHP Extension</li>
						<li>Mbstring PHP Extension</li>
						<li>OpenSSL PHP Extension</li>
						<li>PDO PHP Extension</li>
						<li>Tokenizer PHP Extension</li>
						<li>XML PHP Extension</li>
					</ol>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem similique commodi, quisquam perferendis suscipit consectetur illo quidem veniam delectus amet optio soluta, provident distinctio. Laudantium voluptatem consequatur repellendus eius saepe!</p>

					<h5 id="1-2">Installation</h5>
					<ol>
						<li>Download latest stable version .Zip from <a href="#">here</a> or Clone/Download from <a href="#">Github</a></li>
						<li>Extract .Zip contents to desired project location</li>
						<li>Edit the .env and set your database connection details <small>(Duplicate .env.example and rename to .env)</small>.</li>
					</ol>
					<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptate deserunt velit facere quisquam cum accusamus neque magni soluta ea vero. Ipsa maxime sapiente repellat nam ipsum esse et dolorem explicabo?</p>
				</div>
			</div>

			<!-- Pagination -->
			<!-- <ul class="pagination justify-content-center mb-4">
				<li class="page-item">
					<a class="page-link" href="#">&larr; Older</a>
				</li>
				<li class="page-item disabled">
					<a class="page-link" href="#">Newer &rarr;</a>
				</li>
			</ul> -->
		</div>

		<!-- Sidebar Widgets Column -->
		<div class="col-md-4 col-lg-3 order-1 order-md-2">
			<!-- Side Widget -->
			<div class="card text-white bg-dark my-4">
				<h5 class="card-header">
					About META
				</h5>
				<div class="card-body">
					Some short information about myself...
				</div>
			</div>
			<a href="https://join.slack.com/t/metagrenade/shared_invite/enQtNjc1MjQ0ODc4OTE5LTNhM2RlN2M5NmM2ODBjOTYwY2Q4ZTljYjYwZmY4NTMzZWMzNDZkY2YxMzk2NTNlNTZmNmY3ZTEzZmE3YmQyM2M" class="btn btn-light btn-slack w-100">Need Help? Join Slack <fa :icon="['fab', 'slack']" fixed-width/></a>
			<!-- Side Widget -->
			<div class="card my-4" id="scrollspy">
				<h5 class="card-header">
					Contents
				</h5>
				<div class="card-body">
					<ul>
						<li class="text-orange"><a href="#1"><strong>Getting Started</strong></a></li>
						<li class="text-light-orange ml-4"><a href="#1-1">Requirements</a></li>
						<li class="text-light-orange ml-4"><a href="#1-2">Installation</a></li>
					</ul>
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

	},
	//   middleware: 'auth',
	data () {
		return {}
	},
	metaInfo () {
		return { 
			title: this.$t('documentation') 
		}
	},
	computed: {

	},
	mounted() {
		
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

	#scrollspy {
		ul {
			list-style: none;
		}

		a {
			color: inherit;
		}
	}
	.card-columns {
		@include media-breakpoint-only(lg) {
			column-count: 2;
		}
		@include media-breakpoint-only(xl) {
			column-count: 3;
		}
	}
</style>
