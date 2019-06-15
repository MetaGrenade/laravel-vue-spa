import axios from 'axios'

// state
export const state = {
  roles: [],
}

// getters
export const getters = {
  roles: state => state.roles,
}

// mutations
export const mutations = {
	CREATE_ROLE(state, role) {
        state.roles.unshift(role)
    },
    FETCH_ROLES(state, roles) {
        return state.roles = roles
    },
    DELETE_ROLE(state, role) {
        let index = state.roles.findIndex(item => item.id == role.id)
        // console.log(index)
        state.roles.splice(index, 1)
	}
}

// actions
export const actions = {
	createRole({commit}, role) {
        axios.post('/api/admin/roles', role)
            .then(res => {
                commit('CREATE_ROLE', res.data)
            }).catch(err => {
                console.log(err)
            })
    },
    fetchRoles({commit}) {
        axios.get('/api/admin/roles')
            .then(r => r.data)
            .then(roles => {
                commit('FETCH_ROLES', roles)
            })
    },
    deleteRole({commit}, role) {
        axios.delete(`/api/admin/roles/${role.id}`)
            .then(res => {
                if (res.status === 204)
                    commit('DELETE_ROLE', role)
            }).catch(err => {
                console.log(err)
            })
	},
}
