export default {
    namespaced: true,
    state: () => ({
        message: {}
    }),
    getters: {
        getMassage(state) {
            return state.message
        }
    },
    mutations: {
        addMessage(state, message) {
            state.message = message
        }
    },
}
