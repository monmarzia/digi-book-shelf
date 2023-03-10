import LoginPage from './components/LoginPage.vue';
import DashBoard from './components/DashBoard.vue';
import BookDetail from './components/BookDetail.vue';

const routes = [
    {path: '/', component: LoginPage},
    {path: '/dashboard/:userId', component: DashBoard, props: true},
    {path: '/dashboard/:userId/:bookId', component: BookDetail, props: true},
];
export default routes;