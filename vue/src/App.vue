<template>
  <AppChrome>
    <RouterView />
  </AppChrome>
</template>

<script>
import AppChrome from '@/components/layout/AppChrome.vue';

export default {
  name: 'App',
  components: {
    AppChrome,
  },
};
</script>
