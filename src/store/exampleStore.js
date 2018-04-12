export const strict = true;

export const namespaced = true;

export const state = () => ({
  entities: {
    sample: {
      id: 1,
      message: "example"
    }
  }
});

export const actions = {};

export const mutations = {};

export const getters = {
  byId: state => id => state.entities[id]
};
