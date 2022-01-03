export function user(state) {
  return state.user;
}

export function isAdmin(state) {
  return state.user.role === 'superadmin';
}

export function isLoggedIn(state) {
  return state.user.token !== null;
}
