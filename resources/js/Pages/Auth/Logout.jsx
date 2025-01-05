import { useForm } from '@inertiajs/react';

export default function LogoutButton() {
    const { post } = useForm();

    const handleLogout = () => {
        post('/logout');
    };

    return (
        <button onClick={handleLogout} className="btn btn-danger">
            Logout
        </button>
    );
}
