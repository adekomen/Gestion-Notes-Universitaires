import React from 'react';
import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';


import { createInertiaApp } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';
import Navbar from './Component/tete';




console.log('React app.jsx chargé avec succès'); // Vérification que le fichier est exécuté.
createInertiaApp({
  resolve: name => {
    console.log(`Chargement du composant ${name}`); // Log pour chaque composant.
        const pages = import.meta.glob('./Pages/**/*.jsx', { eager:true})
        return pages [`./Pages/${name}.jsx`]},
  
  
        setup({ el, App, props }) {
          console.log('Initialisation de l\'application React'); // Vérification de l'initialisation.
    createRoot(el).render( 
   
      <App {...props} />
   );
  },
});
 