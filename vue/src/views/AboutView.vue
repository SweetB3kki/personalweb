<template>
  <div class="about-page">
    <WindowFrame title="Досье" :icon="profile.mark">
      <div class="profile-sheet">
        <img :src="profile.avatar" :alt="profile.name" class="profile-sheet__photo" />
        <div class="profile-sheet__content">
          <h1 class="pixel-text">{{ profile.name }}</h1>
          <p class="profile-sheet__lead">{{ profile.role }}</p>
          <p v-for="paragraph in aboutParagraphs" :key="paragraph" class="profile-sheet__paragraph">
            {{ paragraph }}
          </p>
        </div>
      </div>
    </WindowFrame>

    <div class="about-page__grid">
      <WindowFrame title="Образование" :icon="profile.mark">
        <div class="timeline">
          <article v-for="item in education" :key="item.title" class="timeline__item">
            <p class="pixel-text timeline__period">{{ item.period }}</p>
            <h2>{{ item.title }}</h2>
            <p>{{ item.details }}</p>
          </article>
        </div>
      </WindowFrame>

      <WindowFrame title="Навыки" :icon="profile.mark">
        <div class="skills-block">
          <section>
            <h2 class="pixel-text skills-block__title">Soft Skills</h2>
            <ul class="skill-list">
              <li v-for="skill in softSkills" :key="skill">{{ skill }}</li>
            </ul>
          </section>
          <section>
            <h2 class="pixel-text skills-block__title">Hard Skills</h2>
            <ul class="skill-list">
              <li v-for="skill in hardSkills" :key="skill">{{ skill }}</li>
            </ul>
          </section>
        </div>
      </WindowFrame>
    </div>
  </div>
</template>

<script>
import WindowFrame from '@/components/ui/WindowFrame.vue';
import {
  aboutParagraphs,
  education,
  hardSkills,
  profile,
  softSkills,
} from '@/data/siteContent';

export default {
  name: 'AboutView',
  components: {
    WindowFrame,
  },
  data() {
    return {
      aboutParagraphs,
      education,
      hardSkills,
      profile,
      softSkills,
    };
  },
};
</script>

<style scoped>
.about-page {
  display: grid;
  gap: 1.2rem;
}

.about-page__grid {
  display: grid;
  grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
  gap: 1.2rem;
  align-items: start;
}

.profile-sheet {
  display: grid;
  grid-template-columns: 300px minmax(0, 1fr);
  gap: 1.5rem;
  align-items: start;
}

.profile-sheet__photo {
  width: 100%;
  aspect-ratio: 1 / 1;
  object-fit: cover;
  border: 2px solid #5f5f5f;
  border-top-color: #f7f7f7;
  border-left-color: #f7f7f7;
}

.profile-sheet__content h1 {
  margin: 0 0 0.8rem;
  font-size: clamp(2rem, 3vw, 3rem);
  line-height: 1.2;
}

.profile-sheet__lead,
.profile-sheet__paragraph,
.timeline__item p,
.skill-list li {
  margin: 0;
  font-size: 1.25rem;
  line-height: 1.45;
}

.profile-sheet__lead {
  margin-bottom: 1rem;
  color: var(--text-soft);
}

.profile-sheet__paragraph + .profile-sheet__paragraph {
  margin-top: 0.95rem;
}

.timeline {
  display: grid;
  gap: 1rem;
}

.timeline__item {
  padding: 1rem;
  border: 2px solid #b9b9b9;
  border-right-color: #f5f5f5;
  border-bottom-color: #f5f5f5;
  background: rgba(255, 255, 255, 0.8);
}

.timeline__item h2 {
  margin: 0 0 0.8rem;
  font-size: 2rem;
}

.timeline__period {
  margin-bottom: 0.7rem;
  color: #27479b;
}

.skills-block {
  display: grid;
  gap: 1.1rem;
}

.skills-block__title {
  margin: 0 0 0.7rem;
  color: #24459f;
  font-size: 1.2rem;
}

.skill-list {
  display: grid;
  gap: 0.55rem;
  margin: 0;
  padding-left: 1.2rem;
}

@media (max-width: 980px) {
  .about-page__grid,
  .profile-sheet {
    grid-template-columns: 1fr;
  }
}
</style>
