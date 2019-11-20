/* global localStorage */

let user = localStorage.getItem('user') || null;
if(user) {
    user = JSON.parse(user);
}
export default {
    notification: null,
    user:  user,
    links: null,
    meta: null,
    token: localStorage.getItem('token') || null,
}
