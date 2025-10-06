import React, { useState, useEffect } from 'react'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import Layout from './components/Layout'
import Dashboard from './pages/Dashboard'
import Appointments from './pages/Appointments'
import Barbers from './pages/Barbers'
import Services from './pages/Services'
import Clients from './pages/Clients'
import { ApiProvider } from './contexts/ApiContext'

function App() {
  return (
    <ApiProvider>
      <Router>
        <Layout>
          <Routes>
            <Route path="/" element={<Dashboard />} />
            <Route path="/appointments" element={<Appointments />} />
            <Route path="/barbers" element={<Barbers />} />
            <Route path="/services" element={<Services />} />
            <Route path="/clients" element={<Clients />} />
          </Routes>
        </Layout>
      </Router>
    </ApiProvider>
  )
}

export default App