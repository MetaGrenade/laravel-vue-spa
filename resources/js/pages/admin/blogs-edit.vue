<template>
	<div class="row">
		<div class="col-12">
			<form @submit.prevent="update" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
      			<alert-success :form="form" :message="$t('blog_updated')" />
				<div class="row">
					<div class="form-group col-6">
						<h1>Edit Blog</h1>
					</div>
					<div class="form-group col-6 pt-2 text-right">
						<!-- Submit Button -->
						<v-button :loading="form.busy" type="success">
							{{ $t('save_update') }}
						</v-button>
					</div>
					<hr />
					<div class="form-group col-12 col-lg-6">
						<label for="title">Title:</label>
						<input v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" type="text" class="form-control" id="title">
						<has-error :form="form" field="title"></has-error>
					</div>
					<div class="form-group col-12 col-lg-6">
						<label for="seo_url">SLUG: <small>(SEO URL)</small></label>
						<input v-model="form.slug" :class="{ 'is-invalid': form.errors.has('slug') }" type="text" class="form-control" id="slug" placeholder="unique_slug">
						<has-error :form="form" field="slug"></has-error>
					</div>
					<div class="form-group col-12 col-lg-6">
						<label for="category_id">Category:</label>
						<select v-model="form.category_id" :class="{ 'is-invalid': form.errors.has('category') }" name="category_id" class="form-control" id="category_id">
							<option value="" disabled>- Select A Category -</option>
							<option v-for="(category, index) in blog_categories" v-bind:category="category" :key="index" v-bind:value="category.id">{{ category.title }}</option>
						</select>
						<has-error :form="form" field="category"></has-error>
					</div>
					<div class="form-group col-12 col-lg-6">
						<label for="title">Published:</label>
						<select v-model="form.published" :class="{ 'is-invalid': form.errors.has('published') }" name="published" class="form-control" id="published">
							<option value="">- Select Status -</option>
							<option value="1">Published</option>
							<option value="0">Draft</option>
						</select>
						<has-error :form="form" field="published"></has-error>
					</div>
					
					<div class="form-group col-12">
						<label for="image">Image: <small v-if="form.image !== ''" class="text-muted">Current = {{ form.image }}</small></label>
						<input type="file" name="image" class="form-control" ref="fileUpload" v-on:change="onFileChange">
						<small id="imageHelp" class="form-text text-muted">Selecting a new image will override the image listed above!</small>
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
							{{ $t('save_update') }}
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
import { Form, HasError, AlertError } from 'vform'
import axios from 'axios'

export default {
	scrollToTop: false,

	metaInfo () {
			return { title: this.$t('blog_edit') }
	},

	data () {
		return {
			form: new Form({
				title: '',
				slug: '',
				category_id: '',
				published: '',
				image: '',
				intro: '',
				content: '',
			}),
			previewImage: '',
			blog_categories: []
		}
	},

	computed: {
		
	},

	created () {
		// Fill the form with blog data from API or STORE.
		this.getBlog()
	},

	methods: {
		getBlog: async function() {
			// get blog data from store or api ?
			await axios.get('/api/admin/blogs/' + this.$route.params.id)
				.then(response => {
					// console.log(response)
					this.form.keys().forEach(key => {
						this.form[key] = response.data.blog[key]
					})
					this.blog_categories = response.data.blog_categories
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
		async update () {
			// Submit the form via a POST request
			await this.form.patch('/api/admin/blogs/'+this.$route.params.id)
				.then((response)=>{
					console.log(response)
					return response.json()
				})
				.then(({ data }) => {
					console.log(data) 
					alert('YAY')
					
					// Update the blog Store.
					// await this.$store.dispatch('updateBlog', { blog: data })
					
					this.form.reset()
				})
				.catch(error => {
					console.log(error)
				});

			// this.$router.push({ name: 'home' })
			// this.form.reset()
		}
	}
}
</script>
