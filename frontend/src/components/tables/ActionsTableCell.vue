<template>
  <q-td>
    <div class="inline-block row q-gutter-sm gt-md">
      <q-btn
        v-for="(action, index) in actions"
        :key="index"
        dense
        round
        :color="action.color"
        :icon="action.icon"
        :title="action.label"
        @click.prevent="action.action(cell)"
      />
    </div>
    <q-btn-dropdown
      class="lt-md"
      color="secondary"
      label="Action"
    >
      <q-list>
        <q-item
          v-for="(action, index) in actions"
          :key="index"
          clickable
          v-close-popup
          @click.prevent="action.action(cell)"
        >
          <q-item-section>
            <q-item-label>
              {{ action.label }}
            </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </q-btn-dropdown>
  </q-td>
</template>
<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'ActionsTableCell',
  props: {
    cell: {
      type: Object,
      default: null,
      required: true,
    },
    actions: {
      type: Array,
      default: null,
      required: false,
    },
  },
});
</script>
