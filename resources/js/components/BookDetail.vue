<template>
  <div class="container d-flex justify-content-between"></div>
  <div class="row">
    <div class="col">
      <h4>Details</h4>
      <p>Author: {{ book.author }}</p>
      <p>ISBN: {{ book.isbn }}</p>
      <p>Added: {{ book.added }}</p>
      <p>Readed: {{ book.readed }}</p>
    </div>
    <div class="col">
      <h2>
        {{ book.title }}
      </h2>
      <h5>Excerpt</h5>
      <p>{{ book.excerpt }}</p>
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
