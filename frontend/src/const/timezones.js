import moment from 'moment-timezone';

const timezones = moment.tz.names();

export const timezoneOptions = timezones.map((tz) => ({
  label: tz.replaceAll('_', ' '),
  value: tz,
}));
