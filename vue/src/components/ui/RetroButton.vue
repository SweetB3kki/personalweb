<template>
  <RouterLink
    v-if="to"
    :to="to"
    class="retro-button pixel-text"
    :class="buttonClass"
  >
    <span class="retro-button__content">
      <slot />
    </span>
  </RouterLink>
  <button
    v-else
    type="button"
    class="retro-button pixel-text"
    :class="buttonClass"
    @click="$emit('click')"
  >
    <span class="retro-button__content">
      <slot />
    </span>
  </button>
</template>

<script>
export default {
  name: 'RetroButton',
  props: {
    to: {
      type: [String, Object],
      default: '',
    },
    variant: {
      type: String,
      default: 'default',
    },
    active: {
      type: Boolean,
      default: false,
    },
  },
  emits: ['click'],
  computed: {
    buttonClass() {
      return {
        'retro-button--primary': this.variant === 'primary',
        'retro-button--active': this.active,
      };
    },
  },
};
</script>

<style scoped>
.retro-button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 46px;
  padding: 0.45rem 1.1rem;
  border: 2px solid #7a7a7a;
  border-top-color: #f7f7f7;
  border-left-color: #f7f7f7;
  background: linear-gradient(180deg, #fafafa 0%, #e7e7e7 45%, #cecece 100%);
  color: #111;
  text-decoration: none;
  cursor: pointer;
  box-shadow: 2px 2px 0 rgba(0, 0, 0, 0.12);
  transition: transform 0.08s ease;
}

.retro-button:hover {
  filter: brightness(1.02);
}

.retro-button:active,
.retro-button--active {
  transform: translate(1px, 1px);
  border-color: #f7f7f7;
  border-top-color: #7a7a7a;
  border-left-color: #7a7a7a;
  background: linear-gradient(180deg, #d4d4d4, #efefef);
}

.retro-button--primary {
  color: #0f2d7d;
}

.retro-button__content {
  white-space: nowrap;
}
</style>
