const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .styles(
        [
            "resources/css/app.css",

            "resources/themeforest/NobleUI/template/assets/vendors/core/core.css",
            "resources/themeforest/NobleUI/template/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css",
            "resources/themeforest/NobleUI/template/assets/fonts/feather-font/css/iconfont.css",
            "resources/themeforest/NobleUI/template/assets/vendors/flag-icon-css/css/flag-icon.min.css",
            "resources/themeforest/NobleUI/template/assets/css/demo1/style.css",
        ],
        "public/css/all.css"
    )
    .scripts(
        [
            "resources/themeforest/NobleUI/template/assets/vendors/core/core.js",
            "resources/themeforest/NobleUI/template/assets/vendors/feather-icons/feather.min.js",
            "resources/themeforest/NobleUI/template/assets/js/template.js",
        ],
        "public/js/all.js"
    );
