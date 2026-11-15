<template>
  <div class="app-shell">
    <div class="app-shell__chrome window-surface">
      <header class="app-shell__titlebar pixel-text">
        <div class="app-shell__brand">
          <img :src="profile.mark" alt="DamnWear mark" class="app-shell__brand-icon" />
          <span>{{ profile.alias }}</span>
        </div>
        <div class="app-shell__title-controls" aria-hidden="true">
          <span></span>
          <span></span>
          <span class="app-shell__close"></span>
        </div>
      </header>

      <nav class="app-shell__menubar">
        <span>File</span>
        <span>Edit</span>
        <span>View</span>
        <span>Favorites</span>
        <span>Help</span>
        <RouterLink
          v-for="link in navigationLinks"
          :key="link.to"
          :to="link.to"
          class="app-shell__menu-link pixel-text"
          :class="{ 'app-shell__menu-link--active': route.path === link.to }"
        >
          {{ link.label }}
        </RouterLink>
      </nav>

      <div class="app-shell__toolbar">
        <div class="app-shell__toolbar-address">
          <span class="pixel-text">damnwear.ru/{{ routeSlug }}</span>
        </div>
        <RetroButton :to="activeRoute.to" variant="primary">
          {{ activeRoute.label }}
        </RetroButton>
        <a class="app-shell__toolbar-link pixel-text" :href="telegramHref" target="_blank" rel="noreferrer">
          Telegram
        </a>
      </div>
    </div>

    <main class="app-shell__main">
      <slot />
    </main>

    <footer class="app-shell__footer window-surface">
      <div class="app-shell__footer-copy">
        <span class="pixel-text">2026 DamnWear.</span>
        <span>Все права защищены.</span>
      </div>

      <img :src="profile.mark" alt="DamnWear mark" class="app-shell__footer-mark" />

      <div class="app-shell__footer-links">
        <RouterLink to="/contacts">Контакты</RouterLink>
        <RouterLink to="/about">О нас</RouterLink>
        <a :href="privacyHref">Политика конфиденциальности</a>
      </div>
    </footer>
  </div>
</template>

<script>
import { computed, watch } from 'vue';
import { useRoute } from 'vue-router';
import RetroButton from '@/components/ui/RetroButton.vue';
import { navigationLinks, profile } from '@/data/siteContent';
import { pushRouteHistory } from '@/data/routeHistory';

export default {
  name: 'AppChrome',
  components: {
    RetroButton,
  },
  setup() {
    const route = useRoute();

    const activeRoute = computed(
      () => navigationLinks.find((item) => item.to === route.path) || navigationLinks[0],
    );

    const routeSlug = computed(() => activeRoute.value.short);
    const telegramHref = `https://example.com/'@', '')}`;
    const privacyHref = `mailto:${profile.email}?subject=${encodeURIComponent('Политика конфиденциальности')}`;

    watch(
      () => route.path,
      () => {
        pushRouteHistory({
          label: activeRoute.value.label,
          to: activeRoute.value.to,
        });
      },
      { immediate: true },
    );

    return {
      activeRoute,
      navigationLinks,
      privacyHref,
      profile,
      route,
      routeSlug,
      telegramHref,
    };
  },
};
</script>

<style scoped>
.app-shell {
  display: flex;
  flex-direction: column;
  gap: 1.2rem;
  max-width: var(--content-width);
  margin: 0 auto;
  padding: 1.5rem;
}

.app-shell__chrome,
.app-shell__footer {
  overflow: hidden;
}

.app-shell__titlebar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  min-height: 42px;
  padding: 0.45rem 0.8rem;
  color: #fff;
  background: linear-gradient(90deg, var(--desktop-blue), var(--desktop-blue-light));
}

.app-shell__brand {
  display: inline-flex;
  align-items: center;
  gap: 0.6rem;
}

.app-shell__brand-icon,
.app-shell__footer-mark {
  width: 28px;
  height: 28px;
  object-fit: contain;
  image-rendering: pixelated;
}

.app-shell__title-controls {
  display: inline-flex;
  gap: 0.35rem;
}

.app-shell__title-controls span {
  position: relative;
  width: 32px;
  height: 28px;
  border: 2px solid #5f5f5f;
  border-top-color: #f7f7f7;
  border-left-color: #f7f7f7;
  background: #d4d0c8;
}

.app-shell__title-controls span::before,
.app-shell__title-controls span::after {
  content: '';
  position: absolute;
  background: #111;
}

.app-shell__title-controls span:first-child::before {
  left: 6px;
  right: 6px;
  bottom: 6px;
  height: 2px;
}

.app-shell__title-controls span:nth-child(2)::before {
  inset: 5px;
  border: 2px solid #111;
  background: transparent;
}

.app-shell__close::before,
.app-shell__close::after {
  left: 50%;
  top: 4px;
  width: 2px;
  height: 18px;
}

.app-shell__close::before {
  transform: translateX(-50%) rotate(45deg);
}

.app-shell__close::after {
  transform: translateX(-50%) rotate(-45deg);
}

.app-shell__menubar {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 1.2rem;
  padding: 0.5rem 0.75rem;
  background: rgba(255, 255, 255, 0.78);
  border-bottom: 1px solid #b7b7b7;
}

.app-shell__menu-link {
  text-decoration: none;
}

.app-shell__menu-link--active {
  color: #10318c;
}

.app-shell__toolbar {
  display: grid;
  grid-template-columns: minmax(0, 1fr) auto auto;
  gap: 0.8rem;
  align-items: center;
  padding: 0.8rem;
}

.app-shell__toolbar-address {
  display: flex;
  align-items: center;
  min-height: 48px;
  padding: 0.6rem 0.9rem;
  border: 2px solid #7a7a7a;
  border-top-color: #9c9c9c;
  border-left-color: #9c9c9c;
  background: rgba(255, 255, 255, 0.92);
}

.app-shell__toolbar-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 46px;
  padding: 0.45rem 1.1rem;
  border: 2px solid #7a7a7a;
  border-top-color: #f7f7f7;
  border-left-color: #f7f7f7;
  background: linear-gradient(180deg, #fafafa, #d9d9d9);
  text-decoration: none;
}

.app-shell__main {
  min-width: 0;
}

.app-shell__footer {
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  gap: 1rem;
  align-items: center;
  padding: 1rem 1.5rem;
}

.app-shell__footer-copy,
.app-shell__footer-links {
  display: flex;
  flex-wrap: wrap;
  gap: 0.8rem;
  align-items: center;
}

.app-shell__footer-links {
  justify-content: flex-end;
}

.app-shell__footer-links a {
  text-decoration: none;
}

@media (max-width: 768px) {
  .app-shell {
    padding: 1rem;
  }

  .app-shell__toolbar {
    grid-template-columns: 1fr;
  }

  .app-shell__footer {
    grid-template-columns: 1fr;
    text-align: center;
  }

  .app-shell__footer-copy,
  .app-shell__footer-links {
    justify-content: center;
  }
}
</style>
