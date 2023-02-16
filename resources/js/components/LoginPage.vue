<template>
  <h2 class="text-center mt-5 py-2 pl-3 pr-9 font-semibold w-full">Login page</h2>
  <div class="shadow-sm w-50 bg-light border border-white mx-auto mt-3 text-center">
    <div class="d-flex justify-content-around">
      <label class="m-2 fs-5" for="selectUser">Select user</label>
      <select class="w-50 m-2" name="selectUser">
        <option value="users">Users</option>
        <template v-for="user in users">
          <option :value="user.id" @click="getUser($event)">
            {{ user.name }}
          </option>
        </template>
      </select>
    </div>
    <div class="d-flex justify-content-around">
      <label class="m-2 fs-5" for="name">User Name</label>
      <input class="m-2 w-50" type="text" name="name" :value="user.name" />
    </div>
    <div class="d-flex justify-content-around">
      <label class="m-2 fs-5" for="email">User Email</label>
      <input class="m-2 w-50" type="text" name="email" :value="user.email" />
    </div>
    <div class="d-flex justify-content-end me-5 mb-2">
      <router-link :to="linkToDashboard">
        <button class="btn bg-white rounded shadow-sm">Go To Dashboard</button>
      </router-link>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      users: [],
      user: {
        name: "",
        email: "",
      },
    };
  },
  mounted() {
    this.loadUsers();
  },
  methods: {
    loadUsers() {
      axios.get("api/users").then((response) => {
        const users = response.data.data;
        this.users = users;
      });
    },
    getUser(e) {
      const url = "api/user/" + e.target.value;
      axios
        .get(url)
        .then((response) => {
          this.user = response.data;
        })
        .catch((e) => console.log("error: ", e.message));
    },
  },
  computed: {
    linkToDashboard() {
      return "/dashboard/" + this.user.id;
    },
  },
};

/**
 * Template:
 * - Impostare dropdown con i nomi degli users
 * - Impostare textfield con nome user selezionato
 * - Impostare textfield email con email dello user selezionato
 * - Impostare bottone "Go to Dashboard" in router-link /dashboard:
 *      va indagato come passaree lo user come props sul router-link
 */
</script>
