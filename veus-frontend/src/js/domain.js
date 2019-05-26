import axios from 'axios'

export const HTTP = axios.create({
  baseURL: 'http://localhost:8888/',
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded'
  }
})

HTTP.interceptors.request.use(
  function (config) {
    const token = JSON.parse(window.sessionStorage.getItem('token'))
    if (token) config.headers.Authorization = `Bearer ${token.access_token}`
    return config
  },
  function (error) {
    return Promise.reject(error)
  }
)
