<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Esdeveniments;
use App\Models\Empreses;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $esdeveniments = Esdeveniments::where('nom', 'LIKE', "%{$query}%")->get();
        $empreses = Empreses::where('nom_empresa', 'LIKE', "%{$query}%")->get();

        return response()->json([
            'esdeveniments' => $esdeveniments,
            'empreses' => $empreses,
        ]);
    }
}