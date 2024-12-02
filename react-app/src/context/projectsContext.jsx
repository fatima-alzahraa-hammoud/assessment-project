import React, {createContext, useEffect, useState} from "react";
import axios from "axios";
import apiRoutes from "../utils/api";

export const projectsContext = createContext();

const ProjectsProvider = ({children}) =>{
    const [projects, setProjects] = useState([]);

    const getProjects = () =>{
        axios.get(apiRoutes.getProjects).then(({data}) =>{
            setProjects(data);
        })
    }

    const createProject = (project) =>{
        axios.post(apiRoutes.getProjects, project, {
            headers:{
                "Content-Type": "application/json",
            }
        }).then(({data}) =>{
            const newProject = data.project;
            setProjects([...projects, newProject]);
        })
    }

    const updateProject = (project) =>{
        axios.post(`${apiRoutes.getProjects}/update`, project, {
            headers:{
                "Content-Type": "application/json",
            }
        }).then(({data}) =>{
            const updatedProject = data.project;
            setProjects(prevProjects => 
                prevProjects.map(p => p.id === updatedProject.id ? updatedProject : p)
            );
        })
    }
    
    const deleteProject = (id) => {
        axios.delete(`${apiRoutes.getProjects}/{id}`, {
            headers:{
                "Content-Type": "application/json",
            }
        }).then(() => {
            setProjects(prevProjects => prevProjects.filter(project => project.id !== id));
        })
    }
    
    
    useEffect(() => {
        getProjects();
      }, []);
    
    return (
    <ProjectsProvider.Provider
        value={{
        projects: projects,
        getProjects,
        createProject,
        updateProject,
        deleteProject,
        }}
    >
        {children}
    </ProjectsProvider.Provider>
    );
};

export default ProjectsProvider;
    