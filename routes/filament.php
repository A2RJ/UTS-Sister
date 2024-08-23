<?php
use App\Http\Controllers\Filament\Wr3\LetterController;


Route::middleware('auth')->prefix('filament')->group(function () {
    Route::controller(LetterController::class)->prefix('warek3')->group(function () {
        Route::get('generate-letter/{researchProposal}', 'generateLetter')->name('filament.generateLetter');
    });
});