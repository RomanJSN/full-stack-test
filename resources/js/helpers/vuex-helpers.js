export function notify(commit, message) {
    commit('notification/addMessage', {
        show: true,
        text: message
    }, { root: true })
}
