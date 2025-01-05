import React from "react";
import { usePage } from "@inertiajs/react";

export default function GuestLayout({ children }) {
    const { csrfToken } = usePage().props;

    if (!csrfToken) {
        console.error("CSRF token is missing!");
        return <div>Loading...</div>;
    }

    return (
        <div className="font-sans text-gray-900 antialiased">
            {/* Wrapper pour centrer le contenu */}
            <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                {/* Logo */}
                <div>
                    <a href="/">
                        <ApplicationLogo className="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </div>

                {/* Contenu principal */}
                <div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {children}
                </div>
            </div>
        </div>
    );
}
