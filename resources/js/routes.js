import LoginPage from './components/LoginPage.vue';
import DashBoard from './components/DashBoard.vue';
import BookDetail from './components/BookDetail.vue';

const routes = [
    {path: '/', component: LoginPage},
    {path: '/dashboard/:userId', component: DashBoard, props: true},
    {path: '/book/detail', component: BookDetail},
];
export default routes;