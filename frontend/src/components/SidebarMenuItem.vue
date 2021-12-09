<template>
  <q-separator v-if="type === 'separator'" spaced />
  <q-item-label v-if="type === 'label'" header>
    {{ title }}
  </q-item-label>
  <q-item
    v-if="type === 'link'"
    clickable
    tag="a"
    target="_blank"
    :href="link"
    :active="isActive(link)"
    active-class="bg-blue-1"
    @click.prevent="proceed(link)"
  >
    <q-item-section
      v-if="icon"
      avatar
    >
      <q-icon :name="icon" color="primary" text-color="white" />
    </q-item-section>

    <q-item-section>
      <q-item-label>{{ title }}</q-item-label>
      <q-item-label caption>
        {{ caption }}
      </q-item-label>
    </q-item-section>
  </q-item>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'SidebarMenuItem',
  props: {
    type: {
      type: String,
      required: true,
    },

    title: {
      type: String,
      required: false,
    },

    caption: {
      type: String,
      default: '',
    },

    link: {
      type: String,
      default: '#',
    },

    icon: {
      type: String,
      default: '',
    },
  },
  methods: {
    isActive(link) {
      return link === this.$route.path;
    },
    proceed(link) {
      this.$router.push(link);
    },
  },
});
</script>
