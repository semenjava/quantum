export function user(state) {
  return state.user;
}

export function isAdmin(state) {
  return state.user.isAdmin;
}

export function isLoggedIn(state) {
  return state.user.token !== null;
}
