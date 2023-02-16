<template>
  <h1 class="text-center">Users</h1>
  <div class="container text-center">
    <!-- Inserire dropdown per selezione user -->
    <select class="w-50 mt-3">
      <option value="users">Users</option>
      <template v-for="user in users">
        <option :value="user.id" @click="getDashboard($event)">
          {{ user.name }}
        </option>
      </template>
    </select>
  </div>
  <div class="text-center">
    <!-- Inserire dropdown per selezione user -->
    <select class="w-50 mt-3">
      <option value="books">Books</option>
      <template v-for="book in allBooks">
        <option :value="book.id" @click="getDashboard($event)">
          {{ book.title }}
        </option>
      </template>
    </select>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data: function () {
    return {
      users: [],
      books: [],
      allBooks: [],
      userId: null,
    };
  },
  mounted() {
    this.loadUsers();
    this.loadBooks();
  },
  methods: {
    loadUsers: function () {
      axios
        .get("/api/users")
        .then((response) => {
          this.users = response.data.data;
          //   this.loading = false;
        })
        .catch((e) => console.log("error: ", e));
    },
    loadBooks: function () {
      axios
        .get("/api/books")
        .then((response) => {
          this.allBooks = response.data.data;
          //   this.loading = false;
        })
        .catch((e) => console.log("error: ", e));
    },
    getDashboard: function (e) {
      if (this.userId === e.target.value) return;
      this.userId = e.target.value;
      axios.get("/api/books").then((response) => {
        this.books = response.data.data;
      });
      console.log("getDashboard", this.userId);
    },
  },
};
</script>
