import Homepage from "../pages/Homepage.vue";
import About from "../pages/About.vue";
import Contact from "../pages/Contact.vue";
import Area from "../pages/Area.vue";
import Street from "../pages/Street.vue";
export default {
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Homepage
        },
        {
            path: "/street",
            name: "street",
            component: Street
        },
        {
            path: "/area",
            name: "area",
            component: Area
        },
        {
            path: "/about",
            name: "about",
            component: About
        },
        {
            path: "/contact",
            name: "contact",
            component: Contact
        }
    ]
};
