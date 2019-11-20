export const SET_USER = (state, payload) => {
    localStorage.setItem('user', JSON.stringify(payload))
    state.user = payload
}

export const REMOVE_USER = (state, payload) => {
    localStorage.removeItem('token')
    state.user = null
}

export const SET_TOKEN = (state, payload) => {
    localStorage.setItem('token', payload)
    state.token = payload
}

export const REMOVE_TOKEN = (state, payload) => {
    localStorage.removeItem('token')
    state.token = null
}

export const SET_NOTIFICATION = (state, payload) => {
    state.notification = payload
    setTimeout(function () {
        state.notification = null
    }, 4000)
}

export const SET_LINKS = (state, payload) => {
    state.links = payload
}

export const SET_META = (state, payload) => {
    state.meta = payload
}

export const PREPEND_TO_LINK = (state, payload) => {
    state.links = state.links.filter((l) => {
        return l.id !== payload.id;
    });
    state.links.push(payload);
    state.meta.total += 1
}

export const APPEND_TO_LINK = (state, payload) => {
    state.links = state.links.filter((l) => {
        return l.id !== payload.id;
    });
    state.links.unshift(payload);
    state.meta.total += 1
}

export const REMOVE_LINK = (state, payload) => {
    state.links = state.links.filter((l) => {
        return l.code !== payload;
    });
    state.meta.total -= 1
}
