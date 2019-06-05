<template>
  	<div class="row">
		<div class="col-12">
			<h1>
				Blog Management <button class="btn btn-success"><fa :icon="'plus'" fixed-width /> Create Blog</button>
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
					<tr v-for="(blog, index) in blogs" :key="index" :blog="blog">
						<td class="text-center align-middle">
							{{ blog.id }}
						</td>
						<td class="align-middle">
							<router-link :to="{ name: 'blog.view', params: { 'id': blog.id } }">
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
			blogs: {}
		}
	},

	// computed: {
	// 	...mapState({
	// 		blogs: 'blogs/fetchBlogs'
	// 	}),
	// },

	created () {
		// Fill the form with blog data.
		this.fetchBlogs()
	},

	// mounted() {
	// 	console.log(this.$store)
	// 	this.$store.dispatch('blogs/fetchBlogs')
	// },

  	methods: {
		async fetchBlogs () {
			// get blog data from api?
			const { data } = await axios.get('/api/admin/blogs')
			// console.log(data)
			this.blogs = data
		},
	  	deleteBlog: async function (blog) {
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
					// this.$store.dispatch('blogs/deleteBlog', blog)
					const { status } = await axios.delete('/api/admin/blogs/'+blog.id)
					// console.log(status)
					if(status === 204){
						Swal.fire({
							type: 'success',
							title: 'Deleted!',
							text: 'Item successfully deleted!',
						});
					} 
					else {
						Swal.fire({
							type: 'error',
							title: this.$t('warning_confirm_title'),
							text: status + ' Error! Please try again later...',
						})
					}
				} else {
					console.log('cancelled')
					// swal("Cancelled", "Your imaginary file is safe :)", "error");
				}
			})
			
			this.blogs.$remove('_'+blog.id)
		},
		hideBlog: async function(blog) {
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
					const { status } = await axios.patch('/api/admin/blogs/'+blog.id+'/unpublish')
					// console.log(status)
					if(status === 200){
						Swal.fire({
							type: 'success',
							title: 'Unpublished!',
							text: 'Item successfully hidden!',
						});
					} 
					else {
						Swal.fire({
							type: 'error',
							title: this.$t('warning_confirm_title'),
							text: status + ' Error! Please try again later...',
						})
					}
				} else {
					console.log('cancelled')
				}
			})
		},
		publishBlog: async function(blog) {
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
					const { status } = await axios.patch('/api/admin/blogs/'+blog.id+'/publish')
					// console.log(status)
					if(status === 200){
						Swal.fire({
							type: 'success',
							title: 'Published!',
							text: 'Item successfully published!',
						});
					} 
					else {
						Swal.fire({
							type: 'error',
							title: this.$t('warning_confirm_title'),
							text: status + ' Error! Please try again later...',
						})
					}
				} else {
					console.log('cancelled')
				}
			})
	  }
  }
}
</script>
