const userDefaultState = {
  id: null,
  name: null,
  email: null,
  lang: null,
  timezone: null,
  token: null,
  isAdmin: false,
};

function state() {
  return {
    user: JSON.parse(JSON.stringify(userDefaultState)),
  };
}

export default state;
export { userDefaultState };
