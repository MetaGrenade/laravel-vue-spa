import axios from 'axios'

// state
export const state = {
  users: [],
}

// getters
export const getters = {
  users: state => state.users,
}

// mutations
export const mutations = {
	CREATE_USER(state, user) {
        state.users.unshift(user)
    },
    FETCH_USERS(state, users) {
        return state.users = users
    },
    DELETE_USER(state, user) {
        let index = state.users.findIndex(item => item.id == user.id)
        // console.log(index)
        state.users.splice(index, 1)
	}
}

// actions
export const actions = {
	createUser({commit}, user) {
        axios.post('/api/admin/users', user)
            .then(res => {
                commit('CREATE_USER', res.data)
            }).catch(err => {
                console.log(err)
            })
    },
    fetchUsers({commit}) {
        axios.get('/api/users')
            .then(r => r.data)
            .then(users => {
                commit('FETCH_USERS', users)
            })
    },
    fetchUsersAdmin({commit}) {
        axios.get('/api/admin/users')
            .then(r => r.data)
            .then(users => {
                commit('FETCH_USERS', users)
            })
    },
    deleteUser({commit}, user) {
        axios.delete(`/api/admin/users/${user.id}`)
            .then(res => {
                if (res.status === 204)
                    commit('DELETE_USER', user)
            }).catch(err => {
                console.log(err)
            })
	},
}
