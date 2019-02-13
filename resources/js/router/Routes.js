import Home from '../views/Home';
import FAQ from '../views/FAQ';
import RedirectToUrl from '../views/RedirectToUrl';

export default [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            index: 0,
            title: 'Home - AvaIre Discord Bot',
            metaTags: [
                {
                    name: 'description',
                    content: 'Lorem ipsum'
                },
            ],
        },
    },
    {
        path: '/faq',
        name: 'faq',
        component: FAQ,
        meta: {
            index: 1,
            title: 'FAQ - AvaIre Discord Bot',
            metaTags: [
                {
                    name: 'description',
                    content: 'Lorem ipsum'
                },
            ],
        },
    },
    {
        path: '/support',
        name: 'support',
        component: RedirectToUrl,
        meta: {
            index: 999,
            title: 'Redirecting to the support server',
        },
    },
    {
        path: '/invite',
        name: 'invite',
        component: RedirectToUrl,
        meta: {
            index: 999,
            title: 'Redirecting to the invite url',
        },
    },
    {
        path: '/*',
        name: 'not-found',
        redirect: '/',
    },
];
