export const getUser = (state) => {
    return state.user
}

export const getLinks = (state) => {
    return state.links
}

export const isLoggedIn = (state) => {
    return !!state.token
}

export const getMeta = (state) => {
    return state.meta
}

export const notification = (state) => {
    return state.notification
}
