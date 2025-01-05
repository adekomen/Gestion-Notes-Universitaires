<?php

namespace App\Http\Controllers;
use App\Models\Elements_constitutif;
use App\Models\Unites_enseignement;
use Inertia\Inertia;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalUE = Unites_enseignement::count();
        $totalEC = Elements_Constitutif::count();
        $ueWithEcCount = Unites_Enseignement::withCount('elementsConstitutifs')->get();

        return Inertia::render('Dashboard', compact('totalUE', 'totalEC', 'ueWithEcCount'));
    }
}
