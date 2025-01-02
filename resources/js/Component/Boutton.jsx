import React from 'react';
import { Link } from '@inertiajs/react'; // Inertia.js Link pour la navigation côté client
import 'boxicons/css/boxicons.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';


export default function NavBar() {
    return (
    <div style={{display:'flex', gap:'30px',marginTop:'50px',animation: 'slideIn 4s ease-out'}}>
    <Link href="" className="btn btn-primary" tabindex="-1" role="button" aria-disabled="false" style={{fontFamily:'Comic Sans MS,impact,Times New Roman,Courier New'}}>Sign Up</Link>
    <Link href="" className="btn btn-secondary" tabindex="-1" role="button" aria-disabled="true" style={{fontFamily:'Comic Sans MS,impact,Times New Roman,Courier New'}}>Login</Link>
    <style>
                {`
                @keyframes slideIn {
                    from {
                        transform: translateX(-100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                `}
            </style>
  </div>); 
}


