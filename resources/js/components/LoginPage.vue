<template>
  <h2 class="text-center mt-5 py-2 pl-3 pr-9 font-semibold w-full">Login page</h2>
  <div class="shadow-sm w-50 bg-light border border-white mx-auto mt-3 text-center">
    <div class="d-flex justify-content-around">
      <label class="m-2 fs-5" for="selectUser">Select user</label>
      <select
        class="w-50 m-2"
        name="selectUser"
        v-model="selectedUser"
        @change="getUser($event)"
      >
        <option disabled value="">Select a User</option>
        <option v-for="user in users" :value="user.id">
          {{ user.name }}
        </option>
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
        <button class="btn bg-white rounded shadow-sm" @click.stop="goToDashboard">
          Go To Dashboard
        </button>
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
      selectedUser: undefined,
    };
  },
  mounted() {
    this.loadUsers();
  },
  methods: {
    async loadUsers() {
      try {
        const res = await axios.get("api/users");
        const users = res.data.data;
        this.users = users;
      } catch (error) {
        console.log("loadUsers: ", error.message);
      }
    },
    async getUser(e) {
      const url = "api/user/" + e.target.value;
      try {
        const res = await axios.get(url);
        this.user = res.data;
      } catch (error) {
        console.log("error: ", error.message);
      }
    },
  },
  computed: {
    linkToDashboard() {
      if (this.user.name === "") return "/";
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
