import {
    LOGIN_API,
    REGISTER_API,
    LOGOUT_API,
    LINKS_API,
    SINGLE_LINK_API,
    USER_LINKS_API,
    PROFILE_API
} from '../api/index'

export const login = ({commit, dispatch}, payload) => {
    return new Promise((resolve, reject) => {

        window.axios.post(LOGIN_API, payload)
            .then(resp => {
                let {data} = resp;
                const access_token = data.access_token
                const token_type = data.token_type
                const token = token_type + ' ' + access_token
                const user = data.user

                commit('SET_TOKEN', token)
                commit('SET_USER', user)

                window.axios.defaults.headers.common['Authorization'] = token

                resolve(resp)
            })
            .catch(err => {

                let data = err.response.data;

                commit('REMOVE_TOKEN')
                commit('SET_NOTIFICATION', {
                    status: 'danger',
                    message: data
                })
                reject(err)
            })
    })
}

export const register = ({commit, dispatch}, payload) => {
    return new Promise((resolve, reject) => {

        window.axios.post(REGISTER_API, payload)
            .then(resp => {
                let data = resp.data;

                commit('SET_NOTIFICATION', {
                    status: 'success',
                    message: data.message
                })
                resolve(resp)
            })
            .catch(err => {
                let data = err.response.data;
                commit('SET_NOTIFICATION', {
                    status: 'danger',
                    message: data
                })
                reject(err)
            })
    })
}

export const logout = ({commit, dispatch}, payload) => {
    return new Promise((resolve, reject) => {

        window.axios.post(LOGOUT_API, payload)
            .then(resp => {

                commit('REMOVE_TOKEN')
                commit('SET_USER', null)

                delete window.axios.defaults.headers.common['Authorization']

                resolve(resp)
            })
            .catch(err => {
                reject(err)
            })
    })
}

export const fetchUserLinks = ({commit, dispatch}, payload) => {
    return new Promise((resolve, reject) => {

        window.axios.get(USER_LINKS_API, payload)
            .then(resp => {
                let {data} = resp.data;
                commit('SET_LINKS', data.data)
                commit('SET_META', data)
                resolve(resp)
            })
            .catch(err => {
                reject(err)
            })
    })
}

export const fetchLinks = ({commit, dispatch}, payload) => {
    return new Promise((resolve, reject) => {

        window.axios.get(LINKS_API, payload)
            .then(resp => {
                let {data} = resp.data;
                commit('SET_LINKS', data.data)
                commit('SET_META', data)
                resolve(resp)
            })
            .catch(err => {
                reject(err)
            })
    })
}

export const showLink = ({commit, dispatch}, payload) => {
    return new Promise((resolve, reject) => {

        let url = SINGLE_LINK_API(payload)

        window.axios.get(url)
            .then(resp => {
                resolve(resp)
            })
            .catch(err => {
                reject(err)
            })
    })
}

export const addLink = ({commit, dispatch}, payload) => {
    return new Promise((resolve, reject) => {
        window.axios.post(LINKS_API, payload)
            .then(resp => {
                let {data} = resp
                commit('APPEND_TO_LINK', data.data)
                commit('SET_NOTIFICATION', {
                    status: 'success',
                    message: data.message
                })
                resolve(resp)
            })
            .catch(err => {
                reject(err)
            })
    })
}

export const removeLink = ({commit, dispatch}, payload) => {
    return new Promise((resolve, reject) => {

        let url = SINGLE_LINK_API(payload)

        window.axios.delete(url, payload)
            .then(resp => {
                let {data} = resp
                commit('SET_NOTIFICATION', {
                    status: 'success',
                    message: data.message
                })
                commit('REMOVE_LINK', payload)
                resolve(resp)
            })
            .catch(err => {
                reject(err)
            })
    })
}

export const fetchUser = ({commit, dispatch}, payload) => {
    return new Promise((resolve, reject) => {

        window.axios.get(PROFILE_API, payload)
            .then(resp => {
                let {data} = resp.data;
                commit('SET_USER', data.data)
                resolve(resp)
            })
            .catch(err => {
                reject(err)
            })
    })
}
