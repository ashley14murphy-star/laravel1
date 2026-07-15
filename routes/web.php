<?php

use App\Models\File;
use App\Models\Document;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

// Main Dashboard Gateway (Loads both sets of data)
Route::get('/dashboard', function () {
    return view('dashboard', [
        'files' => auth()->user()->files ?? collect(),
        'documents' => auth()->user()->documents ?? collect()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- CLOUD STORAGE FILES LAYER ---
    Route::post('/files/upload', function (Request $request) {
        $request->validate(['file' => 'required|file|max:10240']);
        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('user_files/' . auth()->id());

        auth()->user()->files()->create([
            'name' => $uploadedFile->getClientOriginalName(),
            'path' => $path,
        ]);
        return redirect()->back();
    })->name('files.upload');

    Route::get('/files/download/{file}', function (File $file) {
        if ($file->user_id !== auth()->id()) abort(403);
        return Storage::download($file->path, $file->name);
    })->name('files.download');

    Route::delete('/files/{file}', function (File $file) {
        if ($file->user_id !== auth()->id()) abort(403);
        Storage::delete($file->path);
        $file->delete();
        return redirect()->back();
    })->name('files.destroy');

    // --- WRITTEN DOCUMENTS LAYER ---
    Route::post('/documents', function (Request $request) {
        $request->validate(['title' => 'required|string|max:255']);
        auth()->user()->documents()->create([
            'title' => $request->input('title'),
            'content' => ''
        ]);
        return redirect()->back();
    })->name('documents.store');

    Route::put('/documents/{document}', function (Request $request, Document $document) {
        if ($document->user_id !== auth()->id()) abort(403);
        $document->update([
            'content' => $request->input('content')
        ]);
        return redirect()->back();
    })->name('documents.update');

    Route::delete('/documents/{document}', function (Document $document) {
        if ($document->user_id !== auth()->id()) abort(403);
        $document->delete();
        return redirect()->back();
    })->name('documents.destroy');
    
});

require __DIR__.'/auth.php';