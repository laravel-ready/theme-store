require("laravel-mix-purgecss");

const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
const fs = require('fs');
const path = require('path');

const publicWebAssetsFolder = "public/web";

mix.sass(`./sass/web/store.scss`, `${publicWebAssetsFolder}/css/store.min.css`);
mix.sass(`./sass/web/error.scss`, `${publicWebAssetsFolder}/css/error-style.min.css`).options({
    processCssUrls: false,
    postCss: [tailwindcss("./tailwind.config.js")],
});

const publicPanelAssetsFolder = "public/panel";

mix.copyDirectory("apps/panel/dist", `${publicPanelAssetsFolder}`);

mix.css(`${publicPanelAssetsFolder}/css/app.css`, `${publicPanelAssetsFolder}/css/app.min.css`)
.then(stats => {
    // replace font apths for panel public folder structure
    fs.readFile(path.resolve(__dirname, `${publicPanelAssetsFolder}/css/app.min.css`), 'utf8' , (readError, data) => {
        if (readError) {
            console.error("\x1b[31mError: \x1b[0m" + readError);
            return;
        }

        const result = data.replace(new RegExp(/url\(\/fonts\/nucleo-icons/, 'g'), 'url(../fonts/nucleo-icons')
        .replace(new RegExp(/url\(\/fonts\/fa\-/, 'g'), 'url(../fonts/fa-');

        fs.writeFile(path.resolve(__dirname, `${publicPanelAssetsFolder}/css/app.min.css`), result, writeError => {
            if (writeError) {
                console.error("\x1b[31mError: \x1b[0m" + writeError);
                return;
            }

            console.log("Relative theme directory references replaced to full urls!");
        });
    })
});
