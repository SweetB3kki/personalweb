<template>
  <div class="section-link-grid">
    <RetroButton
      v-for="link in links"
      :key="link.to"
      :to="link.to"
      :active="currentPath === link.to"
      variant="primary"
    >
      {{ link.label }}
    </RetroButton>
  </div>
</template>

<script>
import RetroButton from './RetroButton.vue';

export default {
  name: 'SectionLinkGrid',
  components: {
    RetroButton,
  },
  props: {
    links: {
      type: Array,
      required: true,
    },
    currentPath: {
      type: String,
      default: '',
    },
  },
};
</script>

<style scoped>
.section-link-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 0.85rem;
}
</style>
