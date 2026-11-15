<template>
  <div class="desktop-page">
    <div class="desktop-page__grid">
      <WindowFrame title="Профиль" :icon="profile.mark">
        <div class="home-hero">
          <img :src="profile.avatar" :alt="profile.name" class="home-hero__photo" />
          <div class="home-hero__copy">
            <p class="home-hero__eyebrow pixel-text">{{ profile.alias }}</p>
            <h1 class="home-hero__title pixel-text">{{ profile.name }}</h1>
            <p class="home-hero__meta">{{ profile.role }}</p>
            <p class="home-hero__text">{{ profile.intro }}</p>
            <p v-if="profile.summary" class="home-hero__text">{{ profile.summary }}</p>
          </div>
        </div>
      </WindowFrame>

      <WindowFrame title="Ярлыки" :icon="profile.mark">
        <div v-if="recentLinks.length" class="history-list">
          <RouterLink v-for="item in recentLinks" :key="item.to" :to="item.to" class="history-list__item">
            <img :src="profile.mark" alt="" class="history-list__icon" />
            <div>
              <strong class="pixel-text">{{ item.label }}</strong>
              <p>{{ item.to }}</p>
            </div>
          </RouterLink>
        </div>
        <p v-else class="history-empty">История появится после переходов по сайту.</p>
      </WindowFrame>
    </div>

    <WindowFrame title="Системная сводка" :icon="profile.mark">
      <div class="stats-grid">
        <article class="stat-card">
          <span class="pixel-text">Группа</span>
          <strong>{{ profile.group }}</strong>
        </article>
        <article class="stat-card">
          <span class="pixel-text">Город</span>
          <strong>{{ profile.city }}</strong>
        </article>
        <article class="stat-card">
          <span class="pixel-text">Email</span>
          <strong>{{ profile.email }}</strong>
        </article>
        <article class="stat-card">
          <span class="pixel-text">Телеграм</span>
          <strong>{{ profile.telegram }}</strong>
        </article>
      </div>
    </WindowFrame>
  </div>
</template>

<script>
import WindowFrame from '@/components/ui/WindowFrame.vue';
import { profile } from '@/data/siteContent';
import { readRouteHistory } from '@/data/routeHistory';

export default {
  name: 'HomeView',
  components: {
    WindowFrame,
  },
  data() {
    return {
      profile,
      recentLinks: [],
    };
  },
  created() {
    this.syncHistory();
  },
  mounted() {
    window.addEventListener('damnwear:route-history', this.syncHistoryFromEvent);
  },
  beforeUnmount() {
    window.removeEventListener('damnwear:route-history', this.syncHistoryFromEvent);
  },
  methods: {
    syncHistory() {
      this.recentLinks = readRouteHistory();
    },
    syncHistoryFromEvent(event) {
      this.recentLinks = event.detail || readRouteHistory();
    },
  },
};
</script>

<style scoped>
.desktop-page {
  display: grid;
  gap: 1.2rem;
}

.desktop-page__grid {
  display: grid;
  grid-template-columns: minmax(0, 1.35fr) 360px;
  gap: 1.2rem;
  align-items: start;
}

.home-hero {
  display: grid;
  grid-template-columns: 240px minmax(0, 1fr);
  gap: 1.2rem;
  align-items: start;
}

.home-hero__photo {
  width: 100%;
  aspect-ratio: 1 / 1;
  object-fit: cover;
  border: 2px solid #5f5f5f;
  border-top-color: #f7f7f7;
  border-left-color: #f7f7f7;
}

.home-hero__eyebrow {
  margin: 0 0 0.8rem;
  color: #2349b1;
}

.home-hero__title {
  margin: 0 0 1rem;
  font-size: clamp(1.6rem, 2vw, 2.6rem);
  line-height: 1.2;
}

.home-hero__meta,
.home-hero__text,
.history-list__item p,
.history-empty {
  margin: 0;
  font-size: 1.25rem;
  line-height: 1.35;
}

.home-hero__meta {
  margin-bottom: 0.8rem;
  color: var(--text-soft);
}

.home-hero__text + .home-hero__text {
  margin-top: 0.85rem;
}

.history-list {
  display: grid;
  gap: 0.8rem;
}

.history-list__item {
  display: grid;
  grid-template-columns: 26px minmax(0, 1fr);
  gap: 0.7rem;
  align-items: start;
  color: inherit;
  text-decoration: none;
}

.history-list__icon {
  width: 26px;
  height: 26px;
}

.history-list__item strong {
  display: block;
  margin-bottom: 0.35rem;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 0.9rem;
}

.stat-card {
  padding: 0.85rem;
  border: 2px solid #b5b5b5;
  border-right-color: #f5f5f5;
  border-bottom-color: #f5f5f5;
  background: rgba(255, 255, 255, 0.8);
}

.stat-card span {
  display: block;
  margin-bottom: 0.45rem;
  color: #27479b;
}

.stat-card strong {
  font-size: 1.25rem;
  line-height: 1.3;
}

@media (max-width: 1080px) {
  .desktop-page__grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 960px) {
  .home-hero {
    grid-template-columns: 1fr;
  }

  .stats-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}

@media (max-width: 640px) {
  .stats-grid {
    grid-template-columns: 1fr;
  }
}
</style>
