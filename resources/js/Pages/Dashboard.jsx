import React from "react";
import { usePage } from "@inertiajs/react";
import Applayout from "../../js/Pages/layout/Applayout";  // Assurez-vous que ce chemin est correct
import NavigationLayout from "../../js/Pages/layout/AuthenticatedLayout";  // Assurez-vous que ce chemin est correct

export default function Dashboard() {
    // Récupérer les données passées depuis Laravel
    const { totalUE, totalEC, ueWithEcCount } = usePage().props;

    return (
        <Applayout header="Dashboard"> {/* Utilisation d'Applayout avec le titre pour le header */}
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {/* Vous pouvez placer le layout de navigation ici si nécessaire */}
                    <NavigationLayout /> {/* Si nécessaire, inclure la navigation ici */}
                    
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div className="bg-white shadow-md rounded-lg p-6">
                            <h3 className="text-lg font-semibold text-gray-700">Nombre total d'UE</h3>
                            <p className="text-4xl font-bold text-blue-500 mt-4">{totalUE}</p>
                        </div>

                        <div className="bg-white shadow-md rounded-lg p-6">
                            <h3 className="text-lg font-semibold text-gray-700">Nombre total d'EC</h3>
                            <p className="text-4xl font-bold text-green-500 mt-4">{totalEC}</p>
                        </div>

                        <div className="bg-white shadow-md rounded-lg p-6">
                            <h3 className="text-lg font-semibold text-gray-700">Éléments Constitutifs par UE</h3>
                            <ul className="mt-4 space-y-2">
                                {ueWithEcCount.map((ue) => (
                                    <li key={ue.id} className="text-sm text-gray-600">
                                        <span className="font-medium text-gray-800">{ue.nom}</span> :{" "}
                                        <span className="text-gray-500">{ue.elements_constitutifs_count} EC</span>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    </div>

                    <div className="bg-white shadow-md rounded-lg p-6 mt-8">
                        <h3 className="text-lg font-semibold text-gray-700">Statistiques Générales</h3>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <p className="text-sm text-gray-600">Pourcentage des EC attribués à chaque UE</p>
                                {ueWithEcCount.map((ue) => {
                                    const percentage =
                                        totalEC > 0 ? ((ue.elements_constitutifs_count / totalEC) * 100).toFixed(2) : 0;

                                    return (
                                        <div key={ue.id} className="mt-2">
                                            <div className="flex justify-between">
                                                <span className="text-sm text-gray-700">{ue.nom}</span>
                                                <span className="text-sm text-gray-500">{percentage}%</span>
                                            </div>
                                            <div className="bg-gray-200 rounded-full h-2 mt-1">
                                                <div
                                                    className="bg-blue-500 h-2 rounded-full"
                                                    style={{ width: `${percentage}%` }}
                                                ></div>
                                            </div>
                                        </div>
                                    );
                                })}
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Graphiques ou autres analyses à venir...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Applayout>
    );
}
