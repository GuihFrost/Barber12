import React, { useState, useEffect } from 'react'
import { useApi } from '../contexts/ApiContext'
import { Plus, User, Phone, Mail, Calendar, MapPin } from 'lucide-react'

const Clients = () => {
  const { api } = useApi()
  const [clients, setClients] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState(null)

  useEffect(() => {
    fetchClients()
  }, [])

  const fetchClients = async () => {
    try {
      setLoading(true)
      const response = await api.clientsApi.getAll()
      setClients(response.data.data.data || [])
    } catch (err) {
      setError('Erro ao carregar clientes')
      console.error('Error fetching clients:', err)
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
          <h1 className="text-3xl font-bold text-gray-900">Clientes</h1>
          <p className="mt-2 text-gray-600">
            Gerencie o cadastro de clientes
          </p>
        </div>
        <button className="btn btn-primary btn-md">
          <Plus className="h-4 w-4 mr-2" />
          Novo Cliente
        </button>
      </div>

      {error && (
        <div className="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
          <p className="text-red-600">{error}</p>
        </div>
      )}

      <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        {clients.map((client) => (
          <div key={client.id} className="card p-6">
            <div className="flex items-center mb-4">
              <div className="flex-shrink-0">
                <div className="h-12 w-12 rounded-full bg-primary-100 flex items-center justify-center">
                  <User className="h-6 w-6 text-primary-600" />
                </div>
              </div>
              <div className="ml-4">
                <h3 className="text-lg font-medium text-gray-900">{client.name}</h3>
                <p className="text-sm text-gray-500">{client.email}</p>
              </div>
            </div>

            <div className="space-y-2">
              <div className="flex items-center text-sm text-gray-600">
                <Phone className="h-4 w-4 mr-2" />
                <span>{client.phone}</span>
              </div>
              
              <div className="flex items-center text-sm text-gray-600">
                <Mail className="h-4 w-4 mr-2" />
                <span>{client.email}</span>
              </div>

              {client.birth_date && (
                <div className="flex items-center text-sm text-gray-600">
                  <Calendar className="h-4 w-4 mr-2" />
                  <span>{new Date(client.birth_date).toLocaleDateString('pt-BR')}</span>
                </div>
              )}

              {client.address && (
                <div className="flex items-start text-sm text-gray-600">
                  <MapPin className="h-4 w-4 mr-2 mt-0.5 flex-shrink-0" />
                  <span className="truncate">{client.address}</span>
                </div>
              )}
            </div>

            {client.notes && (
              <div className="mt-4">
                <p className="text-sm text-gray-600">
                  <strong>Observações:</strong> {client.notes}
                </p>
              </div>
            )}

            <div className="mt-4 flex justify-between items-center">
              <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${
                client.is_active 
                  ? 'bg-green-100 text-green-800' 
                  : 'bg-red-100 text-red-800'
              }`}>
                {client.is_active ? 'Ativo' : 'Inativo'}
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

export default Clients