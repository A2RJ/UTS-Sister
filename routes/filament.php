<?php
use App\Http\Controllers\Filament\Wr3\LetterController;


Route::middleware('auth')->prefix('filament')->group(function () {
    Route::controller(LetterController::class)->prefix('warek3')->group(function () {
        Route::get('letter/{researchProposal}/proposal', 'generateProposal')->name('filament.generateLetter.proposal');
        Route::get('letter/{dedication}/dedication', 'generateDedication')->name('filament.generateLetter.dedication');
    });
});

Route::get('storage/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);

    if (!File::exists($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath);
})->where('path', '.*');