import Home from '../views/Home';
import Hero from '../views/Hero';
import Commands from '../views/Commands';
import FAQ from '../views/FAQ';

export default [
    {
        path: '/',
        name: 'home',
        components: {
            default: Home,
            hero: Hero,
        },
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
        path: '/commands',
        name: 'commands',
        component: Commands,
        meta: {
            index: 5,
            title: 'Commands - AvaIre Discord Bot',
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
            index: 10,
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
