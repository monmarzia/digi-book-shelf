<template>
  <div class="container d-flex justify-content-between">
    <div class="row mt-5">
      <div class="col col-md-3 text-end mt-5">
        <h4 class="mt-1">Details</h4>
        <p>Author: {{ book.author }}</p>
        <p>ISBN: {{ book.isbn }}</p>
        <p>Added: {{ book.added }} gg/mm/yyyy</p>
        <p>Readed {{ book.readed }}XX times</p>
      </div>
      <div class="col">
        <h2 class="mb-3 text-success">
          {{ book.title }}
        </h2>
        <h4>Excerpt</h4>
        <p>{{ book.excerpt }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["bookId"],
  data() {
    return {
      book: null,
    };
  },
  created() {
    this.getBook();
  },
  methods: {
    async getBook() {
      const url = `/api/book/${this.bookId}/details`;
      try {
        const res = await axios.get(url);
        this.book = res.data;
      } catch (error) {
        console.log("getBook error: ", error.message);
      }
    },
  },
};
</script>

<style scoped></style>
