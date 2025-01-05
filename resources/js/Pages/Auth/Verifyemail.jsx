import React from "react";

export default function VerifyEmail({ status }) {
    return (
        <div style={{ fontFamily: "Arial, sans-serif", padding: "20px", maxWidth: "600px", margin: "auto", textAlign: "center" }}>
            <div style={{ marginBottom: "20px", fontSize: "14px", color: "#4A5568" }}>
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? 
                If you didn't receive the email, we will gladly send you another.
            </div>

            {status === "verification-link-sent" && (
                <div style={{ marginBottom: "20px", fontSize: "14px", fontWeight: "bold", color: "#38A169" }}>
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            )}

            <div style={{ marginTop: "20px", display: "flex", justifyContent: "space-between", alignItems: "center" }}>
                {/* Resend Verification Email */}
                <form method="POST" action="/email/verification-notification" style={{ marginRight: "10px" }}>
                    <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]').content} />
                    <button
                        type="submit"
                        style={{
                            padding: "10px 20px",
                            backgroundColor: "#4F46E5",
                            color: "#FFF",
                            border: "none",
                            borderRadius: "4px",
                            cursor: "pointer",
                        }}
                    >
                        Resend Verification Email
                    </button>
                </form>

                {/* Log Out */}
                <form method="POST" action="/logout" style={{ marginLeft: "10px" }}>
                    <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]').content} />
                    <button
                        type="submit"
                        style={{
                            background: "none",
                            color: "#4A5568",
                            textDecoration: "underline",
                            border: "none",
                            cursor: "pointer",
                            fontSize: "14px",
                        }}
                    >
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    );
}
