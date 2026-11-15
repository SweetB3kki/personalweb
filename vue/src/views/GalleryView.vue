<template>
  <div class="gallery-layout">
    <WindowFrame title="Просмотр" :icon="profile.logo">
      <div class="gallery-hero">
        <img :src="activePhoto.src" :alt="activePhoto.title" class="gallery-hero__image" decoding="async" />
        <div class="gallery-hero__info">
          <h1 class="pixel-text">{{ activePhoto.title }}</h1>
          <p>{{ activePhoto.description }}</p>
          <p>Кадр {{ activeIndex + 1 }} из {{ galleryItems.length }}</p>
          <div class="gallery-hero__actions">
            <RetroButton @click="previousPhoto">&lt; Назад</RetroButton>
            <RetroButton @click="nextPhoto">Далее &gt;</RetroButton>
          </div>
        </div>
      </div>
    </WindowFrame>

    <WindowFrame title="Фотоархив" :icon="profile.mark" flush>
      <div class="gallery-grid scrollbar-win">
        <button
          v-for="(item, index) in galleryItems"
          :key="item.src"
          type="button"
          class="gallery-thumb"
          :class="{ 'gallery-thumb--active': index === activeIndex }"
          @click="setActive(index)"
        >
          <img :src="item.src" :alt="item.title" loading="lazy" decoding="async" />
          <div class="gallery-thumb__meta">
            <strong class="pixel-text">{{ item.title }}</strong>
            <span>{{ item.description }}</span>
          </div>
        </button>
      </div>
    </WindowFrame>
  </div>
</template>

<script>
import RetroButton from '@/components/ui/RetroButton.vue';
import WindowFrame from '@/components/ui/WindowFrame.vue';
import { galleryItems, profile } from '@/data/siteContent';

export default {
  name: 'GalleryView',
  components: {
    RetroButton,
    WindowFrame,
  },
  data() {
    return {
      activeIndex: 0,
      galleryItems,
      profile,
    };
  },
  computed: {
    activePhoto() {
      return this.galleryItems[this.activeIndex];
    },
  },
  methods: {
    nextPhoto() {
      this.activeIndex = (this.activeIndex + 1) % this.galleryItems.length;
    },
    previousPhoto() {
      this.activeIndex = (this.activeIndex - 1 + this.galleryItems.length) % this.galleryItems.length;
    },
    setActive(index) {
      this.activeIndex = index;
    },
  },
};
</script>

<style scoped>
.gallery-layout {
  display: grid;
  gap: 1.2rem;
}

.gallery-hero {
  display: grid;
  grid-template-columns: minmax(0, 1.2fr) 320px;
  gap: 1rem;
  align-items: start;
}

.gallery-hero__image {
  width: 100%;
  height: auto;
  max-height: none;
  object-fit: contain;
  background: #fff;
  border: 2px solid #6f6f6f;
  border-top-color: #f7f7f7;
  border-left-color: #f7f7f7;
}

.gallery-hero__info {
  display: flex;
  flex-direction: column;
  gap: 0.85rem;
}

.gallery-hero__info h1,
.gallery-hero__info p {
  margin: 0;
}

.gallery-hero__info h1 {
  font-size: 1.65rem;
  line-height: 1.25;
}

.gallery-hero__info p {
  font-size: 1.2rem;
  line-height: 1.35;
}

.gallery-hero__actions {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
  margin-top: auto;
}

.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 0.85rem;
  padding: 1rem;
  max-height: 60vh;
  overflow: auto;
}

.gallery-thumb {
  display: grid;
  gap: 0.55rem;
  padding: 0.7rem;
  text-align: left;
  border: 2px solid #7a7a7a;
  border-top-color: #f7f7f7;
  border-left-color: #f7f7f7;
  background: rgba(255, 255, 255, 0.75);
  cursor: pointer;
}

.gallery-thumb img {
  width: 100%;
  aspect-ratio: 4 / 3;
  object-fit: cover;
}

.gallery-thumb__meta {
  display: grid;
  gap: 0.3rem;
}

.gallery-thumb__meta strong {
  color: #2349b1;
}

.gallery-thumb__meta span {
  font-size: 1.1rem;
  line-height: 1.25;
}

.gallery-thumb--active {
  background: #e8eefc;
}

@media (max-width: 900px) {
  .gallery-hero {
    grid-template-columns: 1fr;
  }
}
</style>
