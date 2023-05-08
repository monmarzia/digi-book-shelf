<template>
  <div class="d-flex justify-content-end p-2">
    <button
      class="btn shadow border border-dark bg-success fw-bold text-white"
      @click="addBooks"
    >
      Add books
    </button>
  </div>

  <table class="table table-striped shadow">
    <thead>
      <th class="p-3">Add</th>
      <th class="p-3 text-center">#</th>
      <th class="p-3">Title</th>
      <th class="p-3">Author</th>
    </thead>
    <tbody class="pb-2">
      <template v-for="book in allBooks">
        <tr class="">
          <td class="py-1 text-center">
            <input
              type="checkbox"
              :id="book.id"
              :name="book.id"
              :value="book.id"
              v-model="selectedBooks"
            />
          </td>
          <td class="py-1 text-center">{{ book.id }}</td>
          <td class="py-1 text-start">{{ book.title }}</td>
          <td class="py-1 text-start">{{ book.author }}</td>
        </tr>
      </template>
    </tbody>
  </table>
</template>
<script>
import axios from "axios";
export default {
  emits: ["add-books"],
  props: ["userId", "userBooksIds"],
  data() {
    return {
      allBooks: {},
      selectedBooks: this.userBooksIds
    };
  },
  created() {    
    this.loadBooks();
  },
  methods: {
    addBooks() {
      this.$emit("add-books", this.selectedBooks);
    },
    loadBooks() {
      axios.get("/api/books").then((response) => {
        this.allBooks = response.data.data;        
      });
    },
  },
  computed: {
    
  },
};
</script>
