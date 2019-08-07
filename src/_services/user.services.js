// import config from 'config';
import authHeader from 'src/_helpers/auth-header';

function logout() {
  // remove user from local storage to log user out
  localStorage.removeItem('user');
}

function handleResponse(response) {
  return response.text().then((text) => {
    const data = text && JSON.parse(text);
    if (!response.ok) {
      if (response.status === 401) {
        // auto logout if 401 response returned from api
        logout();
        // eslint-disable-next-line no-restricted-globals
        location.reload(true);
      }

      const error = (data && data.message) || response.statusText;
      return Promise.reject(error);
    }

    return data;
  });
}


function login(username, password) {
  const requestOptions = {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ username, password }),
  };
  console.log("service");
  return fetch(`${process.env.API_URL}/login_check`, requestOptions)
    // eslint-disable-next-line no-use-before-define
    .then(handleResponse)
    .then((user) => {
      console.log("second then");
      // store user details and jwt token in local storage
      // to keep user logged in between page refreshes
      localStorage.setItem('user', JSON.stringify(user));

      return user;
    },
    (error) => {
      console.log(process.env.API_URL);
    });
}

const userService = {
  login,
  logout,
};

export default userService;
