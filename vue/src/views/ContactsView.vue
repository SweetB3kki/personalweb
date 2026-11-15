<template>
  <div class="contacts-layout">
    <WindowFrame title="Связь" :icon="profile.mark">
      <div class="contacts-list">
        <article v-for="item in contacts" :key="item.label" class="contacts-list__item">
          <span class="pixel-text">{{ item.label }}</span>
          <a v-if="item.href" :href="item.href" target="_blank" rel="noreferrer">{{ item.value }}</a>
          <strong v-else>{{ item.value }}</strong>
        </article>
      </div>
    </WindowFrame>

    <WindowFrame title="Локация" :icon="profile.logo" flush>
      <div class="contacts-map">
        <iframe
          title="Севастополь"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.+7 000 000 00 0055!2d33.52355781585968!3d44.61665017910086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40eb06d54f3bcd59%3A0x2b87fbf04f84e0e6!2sSevastopol!5e0!3m2!1sen!2sru!4v1631776117371!5m2!1sen!2sru"
          loading="lazy"
        ></iframe>
      </div>
    </WindowFrame>

    <WindowFrame title="Резюме" :icon="profile.mark">
      <p class="contact-note">
        Если нужен быстрый способ связаться, лучше всего писать в Telegram или на почту. GitHub использую как
        площадку для кода и учебных экспериментов.
      </p>
    </WindowFrame>
  </div>
</template>

<script>
import WindowFrame from '@/components/ui/WindowFrame.vue';
import { contacts, profile } from '@/data/siteContent';

export default {
  name: 'ContactsView',
  components: {
    WindowFrame,
  },
  data() {
    return {
      contacts,
      profile,
    };
  },
};
</script>

<style scoped>
.contacts-layout {
  display: grid;
  grid-template-columns: minmax(0, 0.95fr) minmax(0, 1.05fr);
  gap: 1.2rem;
  align-items: start;
}

.contacts-list {
  display: grid;
  gap: 0.8rem;
}

.contacts-list__item {
  display: grid;
  gap: 0.35rem;
  padding: 0.8rem;
  border: 2px solid #b9b9b9;
  border-right-color: #f5f5f5;
  border-bottom-color: #f5f5f5;
  background: rgba(255, 255, 255, 0.8);
}

.contacts-list__item span {
  color: #2548aa;
}

.contacts-list__item a,
.contacts-list__item strong,
.contact-note {
  font-size: 1.2rem;
  line-height: 1.35;
}

.contacts-map {
  min-height: 420px;
}

.contacts-map iframe {
  width: 100%;
  min-height: 420px;
  border: 0;
}

.contact-note {
  margin: 0;
}

@media (max-width: 900px) {
  .contacts-layout {
    grid-template-columns: 1fr;
  }
}
</style>
