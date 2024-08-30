<?php
use App\Http\Controllers\Filament\Wr3\LetterController;


Route::middleware('auth')->prefix('filament')->group(function () {
    Route::controller(LetterController::class)->prefix('warek3')->group(function () {
        Route::get('letter/{researchProposal}/proposal', 'generateProposal')->name('filament.generateLetter.proposal');
        Route::get('letter/{dedication}/dedication', 'generateDedication')->name('filament.generateLetter.dedication');
    });
});