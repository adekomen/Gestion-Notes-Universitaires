
import Navbar from '../Component/tete';
import Background from '../../images/bibli.jpg';
import { Link } from '@inertiajs/react'; // Inertia.js Link pour la navigation côté client
import Boutton from '../Component/Boutton';
export default function Home() {
    console.log('Le composant Home est rendu'); // Vérification que le composant est rendu.
    return (
    <div style={{backgroundImage: `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url(${Background})`,backgroundSize: 'cover', backgroundPosition: 'center', height: '97vh', backgroundAttachment:'fixed'
    }}>
      
      <Navbar />
      
      <div style={{marginTop:'200px', marginLeft:'70px', width:'43%',height:'47%' }}>
      <h1 style={{color:'white',animation: 'slideIn 2s ease-out',fontSize:'22px',fontFamily:'impact,Comic Sans MS,Times New Roman,Courier New'}}> Bienvenue sur [Nom du Site]</h1>
      <p style={{color:'white',animation: 'slideIn 3s ease-out',fontWeight:'300'}}>Nous sommes heureux de vous accueillir sur notre plateforme de gestion de notes.<br/>
         Simplifiez votre suivi académique et atteignez vos objectifs en toute sérénité.</p>
      
      <Boutton/>
        
    </div>
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
    </div>

    
    );
}
