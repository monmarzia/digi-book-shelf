<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h1 class="text-center m-5">{{ username }}'s Book Shelf</h1>
        <div class="d-flex justify-content-end py-2">
          <button
            id="show-modal"
            class="btn shadow border border-dark bg-success fw-bold text-white"
            @click="showModal = true"
          >
            Add book
          </button>
        </div>
        <transition name="modal">
          <b-s-modal v-if="showModal" @close="showModal = false">
            <template v-slot:header><h3>Add Books to your Book Shelf</h3></template>
            <template v-slot:body>
              <add-books :userId="userId" @add-user-books="addUserBooks"></add-books>
            </template>
            <template v-slot:footer></template>
          </b-s-modal>
        </transition>
        <table class="table table-striped shadow">
          <thead>
            <th class="py-3">#</th>
            <th class="py-3">Titolo</th>
            <th class="py-3">Autore</th>
            <th class="py-3">ISBN</th>
            <th class="py-3">Dettagli</th>
            <th class="py-3">Completato</th>
            <th class="py-3">Elimina</th>
          </thead>
          <!-- @foreach ($books as $book) -->
          <template v-for="book in userBooks">
            <tr class="">
              <th>{{ book.id }}</th>
              <td class="text-start">{{ book.title }}</td>
              <td class="text-start">{{ book.author }}</td>
              <td class="text-start">{{ book.isbn }}</td>
              <td class="text-start">
                <button type="button" class="btn btn-light border shadow-sm">
                  Dettagli
                </button>
              </td>
              <td class="text-center">
                <input type="checkbox" name="reading" value="reading" />
              </td>
              <td class="text-center">
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
              </td>
            </tr>
          </template>
          <!-- @endforeach -->
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
    };
  },
  created() {
    this.getUsername(this.userId);
  },
  methods: {
    async getUsername(userId) {
      try {
        const res = await axios.get(`/api/user/${userId}`);
        this.username = res.data.name;
      } catch (error) {
        console.log("error: ", error.message);
      }
    },
    async addUserBooks(selectedBooks) {
      console.log("selectedBooks: ", selectedBooks);
      this.showModal = false;
      try {
      } catch (error) {
        console.log("error: ", error.message);
      }
      const res = await axios.post(`/api/user/${this.userId}/books/add`, {
        [ids]: selectedBooks,
      });
      console.log("addUserBook: ", res.data);
    },
    loadBooks(userId) {
      const url = `/api/user/${userId}/books`;
      //   console.log("url: ", url);

      axios
        .get(url)
        .then(
          (response) =>
            (this.userBooks =
              response.data) /* console.log("response: ", response.data) */
        )
        .catch((e) => console.log("error: ", e.message));
    },
  },
  computed: {},
};
</script>
