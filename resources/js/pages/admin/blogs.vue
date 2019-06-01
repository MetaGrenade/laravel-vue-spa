<template>
  <div class="row">
    <div class="col-12">
      <h1>
        Blog Management <button class="btn btn-success">
          <fa :icon="'plus'" fixed-width /> Create Blog
        </button>
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
              <router-link :to="{ name: 'blog' }">
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
              <button class="btn btn-sm btn-primary">
                Edit
              </button>
              <button v-if="blog.published" class="btn btn-sm btn-secondary">
                Hide
              </button>
              <button v-else class="btn btn-sm btn-secondary">
                Publish
              </button>
              <button class="btn btn-sm btn-danger">
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
export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('admin_blogs') }
  },

  data () {
    return {
      blogs: [
        {
          id: 1,
          title: 'Some Blog Title Goes Here',
          seo_url: 'some_blog_post_title_goes_here',
          body: 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum ',
          published: true
        },
        {
          id: 2,
          title: 'Another Random Blog Title Simulator!',
          seo_url: 'another_random_blog_title_simulator',
          body: 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum ',
          published: false
        }
      ]
    }
  },

  methods: {

  }
}
</script>
