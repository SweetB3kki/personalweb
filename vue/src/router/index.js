import { createRouter, createWebHistory } from 'vue-router';
import AboutView from '@/views/AboutView.vue';
import ContactsView from '@/views/ContactsView.vue';
import GalleryView from '@/views/GalleryView.vue';
import HomeView from '@/views/HomeView.vue';
import InterestsView from '@/views/InterestsView.vue';
import StudyView from '@/views/StudyView.vue';
import TestView from '@/views/TestView.vue';

const routes = [
  { path: '/', name: 'home', component: HomeView, meta: { label: 'Рабочий стол', slug: 'desktop' } },
  { path: '/about', name: 'about', component: AboutView, meta: { label: 'Обо мне', slug: 'about' } },
  { path: '/contacts', name: 'contacts', component: ContactsView, meta: { label: 'Контакты', slug: 'contacts' } },
  { path: '/gallery', name: 'gallery', component: GalleryView, meta: { label: 'Фотоархив', slug: 'gallery' } },
  { path: '/interests', name: 'interests', component: InterestsView, meta: { label: 'Интересы', slug: 'interests' } },
  { path: '/study', name: 'study', component: StudyView, meta: { label: 'Учёба', slug: 'study' } },
  { path: '/test', name: 'test', component: TestView, meta: { label: 'Тест', slug: 'test' } },
  { path: '/NextAbout', redirect: '/about' },
  { path: '/NextContact', redirect: '/contacts' },
  { path: '/NextPhotoAlbum', redirect: '/gallery' },
  { path: '/NextStudy', redirect: '/study' },
  { path: '/NextTests', redirect: '/test' },
  { path: '/NextInterests', redirect: '/interests' },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior() {
    return { top: 0 };
  },
});

export default router;
