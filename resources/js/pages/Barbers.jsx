import React, { useState, useEffect } from 'react'
import { useApi } from '../contexts/ApiContext'
import { Plus, User, Star, Clock, Scissors } from 'lucide-react'

const Barbers = () => {
  const { api } = useApi()
  const [barbers, setBarbers] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState(null)

  useEffect(() => {
    fetchBarbers()
  }, [])

  const fetchBarbers = async () => {
    try {
      setLoading(true)
      const response = await api.barbersApi.getAll()
      setBarbers(response.data.data || [])
    } catch (err) {
      setError('Erro ao carregar barbeiros')
      console.error('Error fetching barbers:', err)
    } finally {
      setLoading(false)
    }
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
          <h1 className="text-3xl font-bold text-gray-900">Barbeiros</h1>
          <p className="mt-2 text-gray-600">
            Gerencie a equipe de barbeiros
          </p>
        </div>
        <button className="btn btn-primary btn-md">
          <Plus className="h-4 w-4 mr-2" />
          Novo Barbeiro
        </button>
      </div>

      {error && (
        <div className="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
          <p className="text-red-600">{error}</p>
        </div>
      )}

      <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        {barbers.map((barber) => (
          <div key={barber.id} className="card p-6">
            <div className="flex items-center mb-4">
              <div className="flex-shrink-0">
                <div className="h-12 w-12 rounded-full bg-primary-100 flex items-center justify-center">
                  <User className="h-6 w-6 text-primary-600" />
                </div>
              </div>
              <div className="ml-4">
                <h3 className="text-lg font-medium text-gray-900">{barber.name}</h3>
                <p className="text-sm text-gray-500">{barber.email}</p>
              </div>
            </div>

            <div className="space-y-2">
              <div className="flex items-center text-sm text-gray-600">
                <Star className="h-4 w-4 mr-2 text-yellow-400" />
                <span>{barber.rating || 0}/5.0</span>
              </div>
              
              <div className="flex items-center text-sm text-gray-600">
                <Clock className="h-4 w-4 mr-2" />
                <span>{barber.experience_years || 0} anos de experiência</span>
              </div>

              <div className="flex items-center text-sm text-gray-600">
                <Scissors className="h-4 w-4 mr-2" />
                <span>Especialidades: {barber.specialties?.join(', ') || 'N/A'}</span>
              </div>
            </div>

            {barber.bio && (
              <div className="mt-4">
                <p className="text-sm text-gray-600">{barber.bio}</p>
              </div>
            )}

            <div className="mt-4 flex justify-between items-center">
              <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${
                barber.is_active 
                  ? 'bg-green-100 text-green-800' 
                  : 'bg-red-100 text-red-800'
              }`}>
                {barber.is_active ? 'Ativo' : 'Inativo'}
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

export default Barbers