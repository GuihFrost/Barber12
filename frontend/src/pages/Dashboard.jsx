import React, { useState, useEffect } from 'react'
import { useApi } from '../contexts/ApiContext'
import { Calendar, Users, Scissors, DollarSign, Clock, CheckCircle } from 'lucide-react'

const Dashboard = () => {
  const { api } = useApi()
  const [stats, setStats] = useState(null)
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState(null)

  useEffect(() => {
    const fetchStats = async () => {
      try {
        setLoading(true)
        const response = await api.dashboardApi.getStats()
        setStats(response.data)
      } catch (err) {
        setError('Erro ao carregar estatísticas')
        console.error('Error fetching stats:', err)
      } finally {
        setLoading(false)
      }
    }

    fetchStats()
  }, [api])

  if (loading) {
    return (
      <div className="flex items-center justify-center h-64">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-600"></div>
      </div>
    )
  }

  if (error) {
    return (
      <div className="text-center py-12">
        <p className="text-red-600">{error}</p>
      </div>
    )
  }

  const statCards = [
    {
      name: 'Total de Agendamentos',
      value: stats?.total_appointments || 0,
      icon: Calendar,
      color: 'bg-blue-500',
    },
    {
      name: 'Barbeiros Ativos',
      value: stats?.total_barbers || 0,
      icon: Users,
      color: 'bg-green-500',
    },
    {
      name: 'Clientes Cadastrados',
      value: stats?.total_clients || 0,
      icon: Users,
      color: 'bg-purple-500',
    },
    {
      name: 'Serviços Disponíveis',
      value: stats?.total_services || 0,
      icon: Scissors,
      color: 'bg-orange-500',
    },
    {
      name: 'Agendamentos Hoje',
      value: stats?.today_appointments || 0,
      icon: Clock,
      color: 'bg-yellow-500',
    },
    {
      name: 'Confirmados',
      value: stats?.confirmed_appointments || 0,
      icon: CheckCircle,
      color: 'bg-green-600',
    },
  ]

  return (
    <div>
      <div className="mb-8">
        <h1 className="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p className="mt-2 text-gray-600">
          Visão geral do sistema de agendamentos
        </p>
      </div>

      <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        {statCards.map((stat) => {
          const Icon = stat.icon
          return (
            <div key={stat.name} className="card p-6">
              <div className="flex items-center">
                <div className={`flex-shrink-0 p-3 rounded-md ${stat.color}`}>
                  <Icon className="h-6 w-6 text-white" />
                </div>
                <div className="ml-4">
                  <p className="text-sm font-medium text-gray-500">{stat.name}</p>
                  <p className="text-2xl font-semibold text-gray-900">{stat.value}</p>
                </div>
              </div>
            </div>
          )
        })}
      </div>

      <div className="mt-8">
        <div className="card p-6">
          <h3 className="text-lg font-medium text-gray-900 mb-4">
            Resumo dos Agendamentos
          </h3>
          <div className="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div className="text-center">
              <div className="text-2xl font-bold text-yellow-600">
                {stats?.pending_appointments || 0}
              </div>
              <div className="text-sm text-gray-500">Pendentes</div>
            </div>
            <div className="text-center">
              <div className="text-2xl font-bold text-green-600">
                {stats?.confirmed_appointments || 0}
              </div>
              <div className="text-sm text-gray-500">Confirmados</div>
            </div>
            <div className="text-center">
              <div className="text-2xl font-bold text-blue-600">
                {stats?.today_appointments || 0}
              </div>
              <div className="text-sm text-gray-500">Hoje</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default Dashboard