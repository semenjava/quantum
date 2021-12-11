const userDefaultState = {
  id: null,
  name: null,
  email: null,
  lang: null,
  timezone: null,
  token: null,
  isAdmin: false,
};

export default function () {
  return {
    user: JSON.parse(JSON.stringify(userDefaultState)),
  };
}

export { userDefaultState };
