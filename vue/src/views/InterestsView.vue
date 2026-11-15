<template>
  <div class="interest-grid">
    <WindowFrame
      v-for="interest in interests"
      :key="interest.title"
      :title="interest.title"
      :icon="profile.mark"
    >
      <p class="interest-text">{{ interest.description }}</p>
    </WindowFrame>
  </div>
</template>

<script>
import WindowFrame from '@/components/ui/WindowFrame.vue';
import { interests, profile } from '@/data/siteContent';

export default {
  name: 'InterestsView',
  components: {
    WindowFrame,
  },
  data() {
    return {
      interests,
      profile,
    };
  },
};
</script>

<style scoped>
.interest-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 1.2rem;
  align-items: start;
}

.interest-text {
  margin: 0;
  font-size: 1.35rem;
  line-height: 1.35;
}

@media (max-width: 860px) {
  .interest-grid {
    grid-template-columns: 1fr;
  }
}
</style>
