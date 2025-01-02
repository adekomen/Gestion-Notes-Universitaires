import React from 'react';
import { Link } from '@inertiajs/react'; // Inertia.js Link pour la navigation côté client

import 'boxicons/css/boxicons.min.css';

export default function NavBar() {
    return (
        <nav className="bg-blue-600 p-4"  >
            <div style={{ animation: 'slideDown 1s ease-out'}}> {/*Nom de l'animation et sa durée */} 
                
                <div  style={{display:'flex',gap:'30px', justifyContent:'center', fontSize:'15px',fontFamily:'impact,Times New Roman,Comic Sans MS,Courier New',marginTop:'px' }}>
                <Link href="" style={{ textDecoration:'none',color:'white'}}><i class='bx bx-home-alt-2'></i>Home</Link>
                <Link href="/about" style={{ textDecoration:'none',color:'white'}}><i class='bx bx-user'> </i>Login </Link>
                <Link href="/contact" style={{ textDecoration:'none',color:'white'}}><i class='bx bxs-user-account'></i>Sign Up</Link>
                
                </div>
                
                <style>
                {`
                    @keyframes slideDown {
                        from {
                            transform: translateY(-100%);
                            opacity: 0;
                        }
                        to {
                            transform: translateY(0);
                            opacity: 1;
                        }
                    }
                `}
            </style>
            </div>
        </nav>
    );
}
