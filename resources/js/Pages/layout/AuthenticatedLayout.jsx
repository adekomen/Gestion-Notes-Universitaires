import React from 'react';

export default function GuestLayout({ children }) {
    // Récupérer le CSRF token depuis le document HTML
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    return (
        <div className="font-sans text-gray-900 antialiased">
            {/* Structure de la page */}
            <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                {/* Logo de l'application */}
                <div>
                    <a href="/">
                        <img
                            src="/images/logo.svg" // Remplacez par le bon chemin de votre logo
                            alt="Application Logo"
                            className="w-20 h-20 fill-current text-gray-500"
                        />
                    </a>
                </div>

                {/* Contenu principal */}
                <div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {/* Injection du contenu enfant */}
                    {children}
                </div>
            </div>

            {/* Token CSRF injecté pour les requêtes AJAX si nécessaire */}
            <meta name="csrf-token" content={csrfToken} />
        </div>
    );
}
