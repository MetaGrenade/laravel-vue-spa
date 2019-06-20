<template>
	<div class="row">
		<div class="col-12">
			<form @submit.prevent="create" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
      			<alert-success :form="form" :message="$t('blog_created')" />
				<div class="row">
					<div class="form-group col-6">
						<h1>Create Blog</h1>
					</div>
					<div class="form-group col-6 pt-2 text-right">
						<!-- Submit Button -->
						<v-button :loading="form.busy" type="success">
							{{ $t('save_create') }}
						</v-button>
					</div>
					<hr />
					<div class="form-group col-12 col-lg-6">
						<label for="title">Title:</label>
						<input v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" type="text" class="form-control" id="title" placeholder="Catchy Title Here">
						<has-error :form="form" field="title"></has-error>
					</div>
					<div class="form-group col-12 col-lg-6">
						<label for="seo_url">SLUG: <small>(SEO URL)</small></label>
						<input v-model="form.slug" :class="{ 'is-invalid': form.errors.has('slug') }" type="text" class="form-control" id="slug" placeholder="unique-seo-friedly-url-text">
						<has-error :form="form" field="slug"></has-error>
					</div>
					<div class="form-group col-12 col-lg-6">
						<label for="category_id">Category:</label>
						<select v-model="form.category_id" :class="{ 'is-invalid': form.errors.has('category_id') }" name="category_id" class="form-control" id="category_id">
							<option value="" disabled>- Select A Category -</option>
							<option v-for="(category, index) in blog_categories" :key="index" :value="category.id" :disabled="!category.published" :class="{ 'text-muted bg-light': !category.published, 'text-dark': category.published }">{{ category.title }}</option>
						</select>
						<has-error :form="form" field="category"></has-error>
					</div>
					<div class="form-group col-12 col-lg-6">
						<label for="title">Published:</label>
						<select v-model="form.published" :class="{ 'is-invalid': form.errors.has('published') }" name="published" class="form-control" id="published">
							<option value="">- Select Status -</option>
							<option value="true">Published</option>
							<option value="false">Draft</option>
						</select>
						<has-error :form="form" field="published"></has-error>
					</div>
					
					<div class="form-group col-12">
						<label for="image">Image:</label>
						<input type="file" name="image" class="form-control" ref="fileUpload" v-on:change="onFileChange">
						<has-error :form="form" field="image"></has-error>
						<div class="text-center bg-dark p-4 my-3 overflow-hidden rounded border-secondary" v-if="previewImage">
							<p><strong class="text-secondary">Image Preview:</strong></p>
							<img :src="previewImage"/><br/>
							<button class="btn btn-danger" v-on:click="removeImage">Remove Image</button>
						</div>
					</div>

					<div class="form-group col-12">
						<label for="content">Short Intro: (Plain TEXT)</label>
						<textarea v-model="form.intro" :class="{ 'is-invalid': form.errors.has('intro') }" class="form-control" name="intro" id="content" cols="30" rows="5"></textarea>
						<has-error :form="form" field="intro"></has-error>
					</div>
					<div class="form-group col-12">
						<label for="content">Content: (HTML)</label>
						<textarea v-model="form.content" :class="{ 'is-invalid': form.errors.has('content') }" class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
						<has-error :form="form" field="content"></has-error>
					</div>
					<div class="col-12 text-right">
						<!-- Submit Button -->
						<v-button :loading="form.busy" type="success">
							{{ $t('save_create') }}
						</v-button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-12">
			<h3>Preview</h3>
			<p>HTML Rendering of the 'Content' above!</p>
			<hr />
      		<card :title="form.title">
				<div class="row" v-if="previewImage"><img :src="previewImage" class="img-fluid mx-auto"/></div>
				<div v-html="form.content"></div>
			</card>
		</div>
	</div>
</template>

<script>
import axios from 'axios'
import { mapState } from 'vuex'
import { Form, HasError, AlertError } from 'vform'
import Swal from 'sweetalert2'

export default {
	scrollToTop: false,

	metaInfo () {
			return { title: this.$t('blog_create') }
	},

	data () {
		return {
			form: new Form({
				title: null,
				slug: null,
				category_id: '',
				published: false,
				image: null,
				intro: null,
				content: null,
			}),
			previewImage: '',
			blog_categories: []
		}
	},

	computed: {

	},

	created() {
		// Fill the form with blog data from API or STORE.
		this.getBlogCategories()
    },

	methods: {
		getBlogCategories: async function() {
			// get blog data from store or api ?
			await axios.get('/api/blogs/categories')
				.then(response => {
					// console.log(response)
					this.blog_categories = response.data.blog_categories
					// console.log(this.form)
				});
		},
		onFileChange(e) {
			var files = e.target.files || e.dataTransfer.files;
			if (!files.length)
				return;
			this.createImage(files[0]);
			this.form.image = files[0];
		},
		createImage(file) {
			var previewImage = new Image();
			var reader = new FileReader();
			var vm = this;

			reader.onload = (e) => {
				vm.previewImage = e.target.result;
			};

			reader.readAsDataURL(file);
		},
		removeImage: function (e) {
			const input = this.$refs.fileUpload;
			input.value = '';

			this.previewImage = '';
		}, 
		async create () {
			// Submit the form via a POST request
			await this.form.post('/api/admin/blogs')
				.then((response)=>{
					console.log(response)
					// return response.json()
					if(response.status === 201){
						Swal.fire({
							type: 'success',
							title: 'Created!',
							text: 'Blog Post Successfully Created!',
                        });
                        
                        // Update the blog Store.
                        // await this.$store.dispatch('updateBlog', { blog: response.data })

                        this.form.reset()
					}
				})
				.catch(error => {
					console.log(error)
				});

			// this.$router.push({ name: 'admin.blogs' })
			// this.form.reset()
		}
	}
}
</script>
