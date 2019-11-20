const BASE_API_URL = 'http://localhost:8000/api/';

export const LOGIN_API = BASE_API_URL + 'login';

export const REGISTER_API = BASE_API_URL + 'register';

export const LOGOUT_API = BASE_API_URL + 'logout';

export const LINKS_API = BASE_API_URL + 'links';

export const SINGLE_LINK_API = (link) => BASE_API_URL + `links/${link}`;

export const USER_LINKS_API = BASE_API_URL + 'user/links';
