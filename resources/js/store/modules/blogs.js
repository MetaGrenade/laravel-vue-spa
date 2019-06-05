import axios from 'axios'

// state
export const state = {
  blogs: {},
}

// getters
export const getters = {
  blogs: state => state.blogs,
}

// mutations
export const mutations = {
	CREATE_BLOG(state, blog) {
        state.blogs.unshift(blog)
    },
    FETCH_BLOGS(state, blogs) {
        return state.blogs = blogs
    },
    DELETE_BLOG(state, blog) {
        let index = state.blogs.findIndex(item => item.id === blog.id)
        state.blogs.splice(index, 1)
	}
}

// actions
export const actions = {
	createBlog({commit}, blog) {
        axios.post('/api/admin/blogs', blog)
            .then(res => {
                commit('CREATE_BLOG', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    fetchBlogs({commit}) {
        axios.get('/api/admin/blogs')
            .then(res => {
                commit('FETCH_BLOGS', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    deleteBlog({commit}, blog) {
        axios.delete(`/api/admin/blogs/${blog.id}`)
            .then(res => {
                if (res.data === 'ok')
                    commit('DELETE_BLOG', blog)
            }).catch(err => {
            console.log(err)
        })
	}
}
