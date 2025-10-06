import React, { createContext, useContext } from 'react'
import { api } from '../services/api'

const ApiContext = createContext()

export const useApi = () => {
  const context = useContext(ApiContext)
  if (!context) {
    throw new Error('useApi must be used within an ApiProvider')
  }
  return context
}

export const ApiProvider = ({ children }) => {
  return (
    <ApiContext.Provider value={{ api }}>
      {children}
    </ApiContext.Provider>
  )
}