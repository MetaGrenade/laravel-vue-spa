<template>
  	<div class="row">
		<div class="col-12">
			<h1>
				Blog Management <router-link :to="{ name: 'admin.blogs.create' }"><button class="btn btn-success"><fa :icon="'plus'" fixed-width /> Create Blog</button></router-link>
			</h1>
			<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor molestiae et adipisci minima fugiat possimus. Rem quos animi nisi, quod consequatur nemo accusantium quidem magnam officia veniam, voluptas dicta saepe.</p>
			<table class="table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th class="text-center">
							ID
						</th>
						<th>Title</th>
						<th>Author</th>
						<th>Published</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(blog, index) in blogs.blogs" :key="index" :blog="blog">
						<td class="text-center align-middle">
							{{ blog.id }}
						</td>
						<td class="align-middle">
							<router-link :to="{ name: 'blog.view', params: { 'slug': blog.slug } }">
								{{ blog.title }}
							</router-link>
							<div>
								<small class="text-muted">{{ blog.seo_url }}</small>
							</div>
						</td>
						<td class="align-middle">
							John Doe
						</td>
						<td :class="{ 'text-success': blog.published, 'text-danger': !blog.published, 'align-middle': true === true }">
							21 Hours Ago
						</td>
						<td class="align-middle">
							<router-link :to="{ name: 'admin.blogs.edit', params: { id: blog.id } }">
								<button class="btn btn-sm btn-primary">
									Edit
								</button>
							</router-link>
							<button v-if="blog.published" class="btn btn-sm btn-secondary" @click="hideBlog(blog)">
								Hide
							</button>
							<button v-else class="btn btn-sm btn-secondary" @click="publishBlog(blog)">
								Publish
							</button>
							<button class="btn btn-sm btn-danger" @click="deleteBlog(blog)">
								Delete
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
  	</div>
</template>

<script>
import axios from 'axios'
import { mapState } from 'vuex'
import Swal from 'sweetalert2'

export default {
	name: "Blogs",
	scrollToTop: false,

	metaInfo () {
			return { title: this.$t('admin_blogs') }
	},

	data () {
		return {
			// blogs: {}
		}
	},

	computed: mapState([
		'blogs'
	]),

	// created () {
	// 	// Fill the form with blog data.
	// 	this.fetchBlogs()
	// },

	mounted() {
		this.$store.dispatch('blogs/fetchBlogsAdmin')
	},

  	methods: {
	  	deleteBlog: async function (blog) {
			var self = this;
		  	Swal.fire({
				type: 'question',
				title: this.$t('warning_confirm_title'),
				text: this.$t('warning_confirm_delete'),
				reverseButtons: true,
				confirmButtonText: this.$t('delete'),
				showCancelButton: true,
				cancelButtonText: this.$t('cancel')
			})
			.then(async function(e) {
				if (e.value === true) {
					self.$store.dispatch('blogs/deleteBlog', blog)
					Swal.fire({
						type: 'success',
						title: 'Deleted!',
						text: 'Item successfully deleted!',
					});
				} else {
					console.log('cancelled')
					// swal("Cancelled", "Your imaginary file is safe :)", "error");
				}
			})
		},
		hideBlog: async function(blog) {
			var self = this;
		  	Swal.fire({
				type: 'question',
				title: this.$t('warning_confirm_title'),
				text: this.$t('warning_confirm_hide'),
				reverseButtons: true,
				confirmButtonText: this.$t('ok'),
				showCancelButton: true,
				cancelButtonText: this.$t('cancel')
			})
			.then(async function(e) {
				if (e.value === true) {
					self.$store.dispatch('blogs/unpublishBlog', blog)
					Swal.fire({
						type: 'success',
						title: 'Unpublished!',
						text: 'Item successfully unpublished!',
					});
				} else {
					console.log('cancelled')
				}
			})
		},
		publishBlog: async function(blog) {
			var self = this;
		  	Swal.fire({
				type: 'question',
				title: this.$t('warning_confirm_title'),
				text: this.$t('warning_confirm_publish'),
				reverseButtons: true,
				confirmButtonText: this.$t('ok'),
				showCancelButton: true,
				cancelButtonText: this.$t('cancel')
			})
			.then(async function(e) {
				if (e.value === true) {
					self.$store.dispatch('blogs/publishBlog', blog)
					Swal.fire({
						type: 'success',
						title: 'Published!',
						text: 'Item successfully published!',
					});
				} else {
					console.log('cancelled')
				}
			})
	  	}
  	}
}
</script>
