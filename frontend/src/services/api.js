import axios from 'axios'

const api = axios.create({
  baseURL: '/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
})

api.interceptors.response.use(
  (response) => response,
  (error) => {
    console.error('API Error:', error)
    return Promise.reject(error)
  }
)

export const appointmentsApi = {
  getAll: (params = {}) => api.get('/v1/appointments', { params }),
  getById: (id) => api.get(`/v1/appointments/${id}`),
  create: (data) => api.post('/v1/appointments', data),
  update: (id, data) => api.put(`/v1/appointments/${id}`, data),
  delete: (id) => api.delete(`/v1/appointments/${id}`),
  getByBarber: (barberId) => api.get(`/v1/appointments/barber/${barberId}`),
  getByClient: (clientId) => api.get(`/v1/appointments/client/${clientId}`),
  getByDate: (date) => api.get(`/v1/appointments/date/${date}`),
  confirm: (id) => api.post(`/v1/appointments/${id}/confirm`),
  cancel: (id) => api.post(`/v1/appointments/${id}/cancel`),
}

export const barbersApi = {
  getAll: (params = {}) => api.get('/v1/barbers', { params }),
  getById: (id) => api.get(`/v1/barbers/${id}`),
  create: (data) => api.post('/v1/barbers', data),
  update: (id, data) => api.put(`/v1/barbers/${id}`, data),
  delete: (id) => api.delete(`/v1/barbers/${id}`),
  getAppointments: (id) => api.get(`/v1/barbers/${id}/appointments`),
  getSchedule: (id, date) => api.get(`/v1/barbers/${id}/schedule`, { params: { date } }),
}

export const servicesApi = {
  getAll: (params = {}) => api.get('/v1/services', { params }),
  getById: (id) => api.get(`/v1/services/${id}`),
  create: (data) => api.post('/v1/services', data),
  update: (id, data) => api.put(`/v1/services/${id}`, data),
  delete: (id) => api.delete(`/v1/services/${id}`),
  getByCategory: (category) => api.get(`/v1/services/category/${category}`),
}

export const clientsApi = {
  getAll: (params = {}) => api.get('/v1/clients', { params }),
  getById: (id) => api.get(`/v1/clients/${id}`),
  create: (data) => api.post('/v1/clients', data),
  update: (id, data) => api.put(`/v1/clients/${id}`, data),
  delete: (id) => api.delete(`/v1/clients/${id}`),
  getAppointments: (id) => api.get(`/v1/clients/${id}/appointments`),
  getHistory: (id) => api.get(`/v1/clients/${id}/history`),
}

export const dashboardApi = {
  getStats: () => api.get('/dashboard/stats'),
}

export const healthApi = {
  check: () => api.get('/health'),
}

export { api }