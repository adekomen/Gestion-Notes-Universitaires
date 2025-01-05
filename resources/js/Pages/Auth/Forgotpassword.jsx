import React, { useState } from "react";

export default function Forgotpassword() {
    const [email, setEmail] = useState("");
    const [status, setStatus] = useState("");

    const handleSubmit = async (e) => {
        e.preventDefault();

        const response = await fetch("/verifyemail", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ email }),
        });

        if (response.ok) {
            setStatus("A password reset link has been sent to your email.");
        } else {
            setStatus("Failed to send the reset link. Please try again.");
        }
    };

    return (
        <div className="guest-layout">
            <div className="mb-4 text-sm text-gray-600">
                Forgot your password? No problem. Just let us know your email address, and we will email you a password reset link that will allow you to choose a new one.
            </div>

            {/* Session Status */}
            {status && <div className="mb-4 text-sm text-green-600">{status}</div>}

            <form method="POST" onSubmit={handleSubmit}>
                {/* Email Address */}
                <div>
                    <label htmlFor="email" className="block font-medium text-sm text-gray-700">
                        Email
                    </label>
                    <input
                        id="email"
                        className="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 rounded-md shadow-sm"
                        type="email"
                        name="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        required
                        autoFocus
                    />
                </div>

                <div className="flex items-center justify-end mt-4">
                    <button
                        type="submit"
                        className="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Email Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    );
}
