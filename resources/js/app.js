import "./bootstrap";
import "../css/app.css";

import { createSSRApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { i18nVue } from "laravel-vue-i18n";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createSSRApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(i18nVue, {
                lang: import.meta.env.VITE_LANG,
                resolve: (lang) =>
                    resolvePageComponent(
                        `../../lang/${lang}.json`,
                        import.meta.glob("../../lang/*.json", {
                            eager: true,
                        })
                    ),
            })
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
