// src/services/apiService.js
import axios from 'axios';

// Create an Axios instance
const api = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL || 'http://word-hive.test/api',
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
});

// Request interceptor to add the token
api.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('admin_token'); // assuming token is stored here
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// Response interceptor for global error handling
api.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response) {
            // You can handle specific status codes here
            if (error.response.status === 401) {
                console.error('Unauthorized! Logging out...');
                // e.g., redirect to login
            }
        }
        return Promise.reject(error);
    }
);

// Generic API service
const apiService = {
    get(url, params = {}) {
        return api.get(url, { params });
    },
    post(url, data) {
        return api.post(url, data);
    },
    put(url, data) {
        return api.put(url, data);
    },
    delete(url, data = {}) {
        return api.delete(url, { data });
    },
};

export default apiService;
