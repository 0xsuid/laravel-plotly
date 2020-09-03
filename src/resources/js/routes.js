import PageHome from "./views/Home";
import PagePlot from "./views/Plot";

const routes = [
    {
        path: "/",
        name: 'home',
        component: PageHome
    },
    {
        path: "/plot/:url_hash",
        name: 'plot',
        component: PagePlot
    }
];

export default routes;