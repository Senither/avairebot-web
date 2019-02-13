import Home from '../views/Home';
import FAQ from '../views/FAQ';

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
        path: '/*',
        name: 'not-found',
        redirect: '/',
    },
];
