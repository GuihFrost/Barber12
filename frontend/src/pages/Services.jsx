import React, { useState, useEffect } from 'react'
import { useApi } from '../contexts/ApiContext'
import { Plus, Scissors, Clock, DollarSign, Tag } from 'lucide-react'

const Services = () => {
  const { api } = useApi()
  const [services, setServices] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState(null)

  useEffect(() => {
    fetchServices()
  }, [])

  const fetchServices = async () => {
    try {
      setLoading(true)
      const response = await api.servicesApi.getAll()
      setServices(response.data.data || [])
    } catch (err) {
      setError('Erro ao carregar serviços')
      console.error('Error fetching services:', err)
    } finally {
      setLoading(false)
    }
  }

  const getCategoryColor = (category) => {
    const colors = {
      'Corte': 'bg-blue-100 text-blue-800',
      'Barba': 'bg-green-100 text-green-800',
      'Sobrancelha': 'bg-purple-100 text-purple-800',
      'Bigode': 'bg-orange-100 text-orange-800',
      'Manicure': 'bg-pink-100 text-pink-800',
      'Pedicure': 'bg-red-100 text-red-800',
      'Combo': 'bg-indigo-100 text-indigo-800',
    }
    return colors[category] || 'bg-gray-100 text-gray-800'
  }

  if (loading) {
    return (
      <div className="flex items-center justify-center h-64">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-600"></div>
      </div>
    )
  }

  return (
    <div>
      <div className="mb-8 flex justify-between items-center">
        <div>
          <h1 className="text-3xl font-bold text-gray-900">Serviços</h1>
          <p className="mt-2 text-gray-600">
            Gerencie os serviços oferecidos pela barbearia
          </p>
        </div>
        <button className="btn btn-primary btn-md">
          <Plus className="h-4 w-4 mr-2" />
          Novo Serviço
        </button>
      </div>

      {error && (
        <div className="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
          <p className="text-red-600">{error}</p>
        </div>
      )}

      <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        {services.map((service) => (
          <div key={service.id} className="card p-6">
            <div className="flex items-start justify-between mb-4">
              <div className="flex items-center">
                <div className="flex-shrink-0">
                  <div className="h-12 w-12 rounded-full bg-primary-100 flex items-center justify-center">
                    <Scissors className="h-6 w-6 text-primary-600" />
                  </div>
                </div>
                <div className="ml-4">
                  <h3 className="text-lg font-medium text-gray-900">{service.name}</h3>
                  <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getCategoryColor(service.category)}`}>
                    {service.category}
                  </span>
                </div>
              </div>
            </div>

            {service.description && (
              <p className="text-sm text-gray-600 mb-4">{service.description}</p>
            )}

            <div className="space-y-2">
              <div className="flex items-center text-sm text-gray-600">
                <DollarSign className="h-4 w-4 mr-2 text-green-500" />
                <span className="font-medium">R$ {parseFloat(service.price).toFixed(2)}</span>
              </div>
              
              <div className="flex items-center text-sm text-gray-600">
                <Clock className="h-4 w-4 mr-2 text-blue-500" />
                <span>{service.duration} minutos</span>
              </div>
            </div>

            <div className="mt-4 flex justify-between items-center">
              <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${
                service.is_active 
                  ? 'bg-green-100 text-green-800' 
                  : 'bg-red-100 text-red-800'
              }`}>
                {service.is_active ? 'Ativo' : 'Inativo'}
              </span>
              
              <div className="flex space-x-2">
                <button className="text-primary-600 hover:text-primary-900 text-sm">
                  Editar
                </button>
                <button className="text-red-600 hover:text-red-900 text-sm">
                  Excluir
                </button>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  )
}

export default Services