import { useStore } from 'vuex';

export function currentUserTimezoneDate(dateString) {
  const store = useStore();
  return new Date(dateString).toLocaleString('en-US', {
    timeZone: store.getters['app/user'].timezone || 'UTC',
  });
}

export function UTCtimezoneDate(dateString) {
  return new Date(dateString).toLocaleString('en-US', {
    timeZone: 'UTC',
  });
}
