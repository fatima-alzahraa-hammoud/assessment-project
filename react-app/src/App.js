import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import "./App.css";
import Projects from "./pages/Projects";
import ProjectsProvider from "./context/ProjectsContext";

function App() {
  return (
    <div className="App">
      <BrowserRouter>
        <ProjectsProvider>
          <Routes>
          
            <Route path="/projects" element={<Projects />} />
          </Routes>
        </ProjectsProvider>
      </BrowserRouter>
    </div>
  );
}

export default App;
