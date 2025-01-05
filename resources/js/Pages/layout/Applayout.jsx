import React from 'react';
import AuthenticatedLayout from "../../Pages/layout/AuthenticatedLayout";  // Assurez-vous que ce chemin est correct
import GuestLayout from "../../Pages/layout/GuestLayout";  // Assurez-vous que ce chemin est correct

export default function Applayout({ children, header, isAuthenticated }) {
    return (
        <div>
            <html lang="fr">
                <head>
                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1" />
                    <meta name="csrf-token" content={document.querySelector('meta[name="csrf-token"]').content} />
                    <title>{document.title || 'Laravel App'}</title>

                    {/* Fonts */}
                    <link rel="preconnect" href="https://fonts.bunny.net" />
                    <link
                        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
                        rel="stylesheet"
                    />

                    {/* Scripts */}
                    <script src="/js/app.js" defer></script>
                    <link href="/css/app.css" rel="stylesheet" />
                </head>

                <body className="font-sans antialiased">
                    <div className="min-h-screen bg-gray-100">
                        {/* Conditionally render either the authenticated or guest layout */}
                        {isAuthenticated ? (
                            <AuthenticatedLayout>
                                {/* The navigation and other components can be placed here */}
                                <div className="navigation">
                                    {/* Authenticated navigation would be implemented here */}
                                </div>

                                {/* Page Heading */}
                                {header && (
                                    <header className="bg-white shadow">
                                        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                            {header}
                                        </div>
                                    </header>
                                )}

                                {/* Page Content */}
                                <main>
                                    {children}
                                </main>
                            </AuthenticatedLayout>
                        ) : (
                            <GuestLayout>
                                {/* Guest navigation or elements */}
                                <div className="navigation">
                                    {/* Guest navigation would be implemented here */}
                                </div>

                                {/* Page Heading */}
                                {header && (
                                    <header className="bg-white shadow">
                                        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                            {header}
                                        </div>
                                    </header>
                                )}

                                {/* Page Content */}
                                <main>
                                    {children}
                                </main>
                            </GuestLayout>
                        )}
                    </div>
                </body>
            </html>
        </div>
    );
}
