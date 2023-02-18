<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h1 class="text-center m-5">{{ username }}'s Book Shelf</h1>
        <div class="d-flex justify-content-end m-2">
          <button
            id="addBook"
            class="btn shadow border border-dark bg-success fw-bold text-white me-2"
            @click="showModal = true"
          >
            Add book
          </button>
          <router-link to="/">
            <button class="btn bg-white rounded shadow-sm">Logout</button>
          </router-link>
        </div>
        <transition name="modal">
          <b-s-modal v-if="showModal" @close="showModal = false">
            <template v-slot:header><h3>Add Books to your Book Shelf</h3></template>
            <template v-slot:body>
              <add-books :userId="userId" @add-books="addUserBooks"></add-books>
            </template>
            <template v-slot:footer></template>
          </b-s-modal>
        </transition>
        <table class="table table-striped shadow">
          <thead>
            <th class="p-3">#</th>
            <th class="p-3">Titolo</th>
            <th class="p-3">Autore</th>
            <th class="p-3">ISBN</th>
            <th class="p-3">Dettagli</th>
            <th class="p-3">Completato</th>
            <th class="p-3">Elimina</th>
          </thead>
          <tbody class="pb-2">
            <template v-for="book in userBooks">
              <tr class="">
                <th>{{ book.id }}</th>
                <td class="py-1 text-start">{{ book.title }}</td>
                <td class="py-1 text-start">{{ book.author }}</td>
                <td class="py-1 text-start">{{ book.isbn }}</td>
                <td class="py-1 text-start">
                  <router-link :to="linkDetails">
                    <button
                      type="button"
                      class="btn btn-light border shadow-sm"
                      @click="goToDetails(book.id)"
                    >
                      Dettagli
                    </button>
                  </router-link>
                </td>
                <td class="py-1 text-center">
                  <input type="checkbox" name="reading" value="reading" />
                </td>
                <td class="py-1 text-center">
                  <button class="btn" @click="removeBook(book.id)">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-trash"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"
                      />
                      <path
                        fill-rule="evenodd"
                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                      />
                    </svg>
                  </button>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import BSModal from "./layout/BSModal.vue";
import AddBooks from "./AddBooks.vue";

export default {
  props: ["userId"],
  components: { BSModal, AddBooks },
  data() {
    return {
      userBooks: [],
      username: "",
      showModal: false,
      selBook: "",
    };
  },
  created() {
    this.getUsername();
    this.loadBooks();
  },
  methods: {
    async getUsername() {
      try {
        const res = await axios.get(`/api/user/${this.userId}`);
        this.username = res.data.name;
      } catch (error) {
        console.log("getUsername error: ", error.message);
      }
    },
    async addUserBooks(selectedBooks) {
      const url = `/api/user/${this.userId}/books/add`;
      this.showModal = false;
      try {
        const res = await axios.post(url, {
          ids: selectedBooks,
        });
        this.userBooks = res.data;
      } catch (error) {
        console.log("addUserBook error: ", error.message);
      }
    },
    async loadBooks() {
      const url = `/api/user/${this.userId}/books`;
      try {
        const res = await axios.get(url);
        this.userBooks = res.data;
      } catch (error) {
        console.log("loadBooks error: ", error.message);
      }
    },
    async removeBook(bookId) {
      const url = `/api/user/${this.userId}/books/remove`;
      try {
        const res = await axios.post(url, { bookId: bookId });
        this.userBooks = res.data;
      } catch (error) {}
    },
    goToDetails(bookId) {
      this.selBook = bookId;
    },
  },
  computed: {
    linkDetails() {
      return `/book/${this.selBook}`;
    },
  },
};
</script>
