<template>
  <div class="container d-flex justify-content-between">
    <div class="row mt-5">
      <div class="col col-md-3 text-start mt-5">
        <h4 class="mt-1 fw-semibold">Details</h4>
        <p class="fw-semibold">
          <span class="text-danger me-2">Author:</span>{{ book.author }}
        </p>
        <p class="fw-semibold">
          <span class="text-danger me-2">ISBN: </span>{{ book.isbn }}
        </p>
        <p class="fw-semibold">
          <span class="text-danger me-2">Added: </span>{{ book.added }}
          gg/mm/yyyy
        </p>
        <p class="fw-semibold">
          <span class="text-danger me-2">Readed </span>{{ book.readed }}
          XX times
        </p>
      </div>
      <div class="col">
        <h2 class="mb-3 text-success fw-bold">
          {{ book.title }}
        </h2>
        <h4 class="fw-semibold">Excerpt</h4>
        <p>{{ book.excerpt }}</p>
        <button class="btn btn-light border shadow-sm" @click="$router.go(-1)">
          Back to Dasboard
        </button>
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
      book: "",
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
