import React, { useState } from "react";

export default function Signup() {
    const [formData, setFormData] = useState({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    });

    const [errors, setErrors] = useState({});

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors({}); // Clear previous errors

        try {
            const response = await fetch("/signup", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify(formData),
            });

            if (!response.ok) {
                const data = await response.json();
                setErrors(data.errors || {});
            } else {
                // Success - redirect or show success message
                window.location.href = "/dashboard";
            }
        } catch (error) {
            console.error("Error during signup:", error);
        }
    };

    return (
        <div className="signup-container">
            <h2 className="text-2xl font-bold mb-4">Sign Up</h2>
            <form onSubmit={handleSubmit}>
                {/* Name */}
                <div>
                    <label htmlFor="name">Name</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value={formData.name}
                        onChange={handleChange}
                        className="input-field"
                        required
                    />
                    {errors.name && <p className="error-text">{errors.name}</p>}
                </div>

                {/* Email */}
                <div>
                    <label htmlFor="email">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value={formData.email}
                        onChange={handleChange}
                        className="input-field"
                        required
                    />
                    {errors.email && (
                        <p className="error-text">{errors.email}</p>
                    )}
                </div>

                {/* Password */}
                <div>
                    <label htmlFor="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        value={formData.password}
                        onChange={handleChange}
                        className="input-field"
                        required
                    />
                    {errors.password && (
                        <p className="error-text">{errors.password}</p>
                    )}
                </div>

                {/* Confirm Password */}
                <div>
                    <label htmlFor="password_confirmation">
                        Confirm Password
                    </label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        value={formData.password_confirmation}
                        onChange={handleChange}
                        className="input-field"
                        required
                    />
                    {errors.password_confirmation && (
                        <p className="error-text">
                            {errors.password_confirmation}
                        </p>
                    )}
                </div>

                {/* Submit */}
                <button type="submit" className="btn btn-primary mt-4">
                    Register
                </button>
            </form>
            <div className="mt-4">
                <a href="/login" className="text-sm text-gray-600">
                    Already registered? Log in here.
                </a>
            </div>
        </div>
    );
}
