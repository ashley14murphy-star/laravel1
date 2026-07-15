<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document; // If your model is named "Document"
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display the user's dashboard with their documents and handle search.
     */
    public function index(Request $request)
    {
        // 1. Start query for documents belonging to the authenticated user
        $query = Document::where('user_id', Auth::id());

        // 2. Apply search filter if the search input is filled
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        // 3. Get the results (latest first)
        $files = $query->latest()->get();

        // 4. Return the dashboard view and pass the $files variable
        return view('dashboard', compact('files'));
    }
}