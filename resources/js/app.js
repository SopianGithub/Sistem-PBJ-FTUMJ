require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp,  Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import Datepicker from 'vue3-date-time-picker';
import 'vue3-date-time-picker/dist/main.css'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .component('inertia-link', Link)
            .component('Datepicker', Datepicker)
            .component('progress', InertiaProgress)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
