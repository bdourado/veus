import axios from 'axios'

export const HTTP = axios.create({
  baseURL: 'http://localhost:8888/',
  mode: 'no-cors',
  headers: {
    'Content-Type': 'application/json',
    'Access-Control-Allow-Origin': '*',
    'Cache-Control': 'no-cache'
  }
})

HTTP.interceptors.request.use(
  function (config) {
    const token = localStorage.getItem('token')
    if (token) config.headers.Authorization = `Bearer ${token}`
    return config
  },
  function (error) {
    return Promise.reject(error)
  }
)
