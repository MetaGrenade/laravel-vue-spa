import axios from 'axios'

// state
export const state = {
    emails: [],
    bulkEmails: [],
}

// getters
export const getters = {
    emails: state => state.emails,
    bulkEmails: state => state.bulkEmails,
}

// mutations
export const mutations = {
    FETCH_EMAILS(state, emails) {
        return state.emails = emails
    },
    FETCH_BULK_EMAILS(state, bulkEmails) {
        return state.bulkEmails = bulkEmails
    },
}

// actions
export const actions = {
    fetchEmails({commit}) {
        axios.get('/api/v1/emails-templates/emails')
            .then(r => r.data)
            .then(emails => {
                commit('FETCH_EMAILS', emails)
            })
    },
    fetchBulkEmails({commit}) {
        axios.get('/api/v1/emails-templates/bulk-emails')
            .then(r => r.data)
            .then(bulkEmails => {
                commit('FETCH_BULK_EMAILS', bulkEmails)
            })
    },
    enableEmail({commit}, user) {
        alert('wow');
    },
    disableEmail({commit}, user) {
        alert('yay');
    },

}
