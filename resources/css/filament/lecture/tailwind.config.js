import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Lecture/**/*.php',
        './resources/views/filament/lecture/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
