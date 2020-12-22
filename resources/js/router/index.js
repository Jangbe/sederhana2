import Home from '../views/Home';
import About from '../views/About';
import notFound from '../views/404';
import Admin from '../views/admin/Index';
import Struct from '../views/admin/Struct';
import Index from '../views/products/Index';
import Show from '../views/products/Show';
import Cart from '../views/carts/Cart';
import Register from '../views/auth/Register';
import Login from '../views/auth/Login';

export default{
    mode: "history",
    linkActiveClass: 'active',
    routes: [
        {
            path: "/",
            component: Home
        },
        {
            path: "/about",
            component: About
        },
        {
            path: "/admin/pesanan/:id_buyer?",
            name: 'admin',
            props: true,
            component: Admin
        },
        {
            path: "/admin/struct/:page?",
            name: 'admin.struct',
            component: Struct,
            props: true
        },
        {
            path: "/auth/signup",
            component: Register
        },
        {
            path: "/auth/signin",
            component: Login
        },
        {
            path: "/belanja/:category?",
            name: 'product',
            component: Index,
            props: true
        },
        {
            path: "/belanja/:category/:id",
            name: 'product.detail',
            component: Show
        },
        {
            path: "/keranjang",
            name: 'cart',
            component: Cart
        },
        {
            path: '*',
            component: notFound
        }
    ]
}
