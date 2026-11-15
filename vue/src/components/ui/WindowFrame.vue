<template>
  <section class="window-frame window-surface">
    <header class="window-frame__titlebar pixel-text">
      <div class="window-frame__title">
        <img v-if="icon" :src="icon" :alt="title" class="window-frame__icon" />
        <span>{{ title }}</span>
      </div>
      <div class="window-frame__controls" aria-hidden="true">
        <span></span>
        <span></span>
        <span class="window-frame__control-close"></span>
      </div>
    </header>
    <div class="window-frame__body" :class="{ 'scrollbar-win': scrollable, 'window-frame__body--flush': flush }">
      <slot />
    </div>
    <footer v-if="$slots.footer" class="window-frame__footer">
      <slot name="footer" />
    </footer>
  </section>
</template>

<script>
export default {
  name: 'WindowFrame',
  props: {
    title: {
      type: String,
      required: true,
    },
    icon: {
      type: String,
      default: '',
    },
    scrollable: {
      type: Boolean,
      default: false,
    },
    flush: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style scoped>
.window-frame {
  display: flex;
  flex-direction: column;
  min-height: 0;
}

.window-frame__titlebar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  min-height: 40px;
  padding: 0.45rem 0.65rem;
  color: #fff;
  background: linear-gradient(90deg, var(--desktop-blue), var(--desktop-blue-light));
}

.window-frame__title {
  display: inline-flex;
  align-items: center;
  gap: 0.6rem;
  min-width: 0;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.window-frame__icon {
  width: 22px;
  height: 22px;
  object-fit: contain;
  image-rendering: pixelated;
}

.window-frame__controls {
  display: inline-flex;
  gap: 0.35rem;
}

.window-frame__controls span {
  position: relative;
  width: 28px;
  height: 24px;
  border: 2px solid #5f5f5f;
  border-top-color: #f7f7f7;
  border-left-color: #f7f7f7;
  background: #d4d0c8;
}

.window-frame__controls span:first-child::before,
.window-frame__controls span:nth-child(2)::before,
.window-frame__control-close::before,
.window-frame__control-close::after {
  content: '';
  position: absolute;
  background: #111;
}

.window-frame__controls span:first-child::before {
  left: 5px;
  right: 5px;
  bottom: 5px;
  height: 2px;
}

.window-frame__controls span:nth-child(2)::before {
  inset: 4px;
  border: 2px solid #111;
  background: transparent;
}

.window-frame__control-close::before,
.window-frame__control-close::after {
  left: 50%;
  top: 4px;
  width: 2px;
  height: 14px;
}

.window-frame__control-close::before {
  transform: translateX(-50%) rotate(45deg);
}

.window-frame__control-close::after {
  transform: translateX(-50%) rotate(-45deg);
}

.window-frame__body {
  padding: 1rem;
  background: rgba(255, 255, 255, 0.6);
}

.window-frame__body--flush {
  padding: 0;
}

.window-frame__footer {
  padding: 0.75rem 1rem 1rem;
  background: rgba(255, 255, 255, 0.55);
}
</style>
