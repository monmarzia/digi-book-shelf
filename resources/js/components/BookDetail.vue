<template>
  <div class="container d-flex justify-content-between">
    <div class="row mt-5">
      <div class="col col-md-3 text-start mt-5">
        <h4 class="mt-1 fw-semibold">Details</h4>
        <p class="fw-semibold">
          <span class="text-danger me-2">Author:</span>{{ book.details.author }}
        </p>
        <p class="fw-semibold">
          <span class="text-danger me-2">ISBN: </span>{{ book.details.isbn }}
        </p>
        <p class="fw-semibold">
          <span class="text-danger me-2"
            >{{ book.removed !== null ? "Removed" : "Added" }}: </span
          >{{ book.removed ?? book.added }}
        </p>
        <p class="fw-semibold">
          <span class="text-danger me-2">Readed </span>{{ book.details.reading }}
          times
        </p>
      </div>
      <div class="col">
        <h2 class="mb-3 text-success fw-bold">
          {{ book.details.title }}
        </h2>
        <h4 class="fw-semibold">Excerpt</h4>
        <p>{{ book.details.excerpt }}</p>
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
  props: ["userId", "bookId"],
  data() {
    return {
      book: {
        details: [],
        added: "",
      },
    };
  },
  created() {
    this.getBook();
  },
  methods: {
    async getBook() {
      const url = `/api/user/${this.userId}/${this.bookId}`;
      try {
        const res = await axios.get(url);
        this.book = res.data;
        console.log("getBook: ", res.data);
      } catch (error) {
        console.log("getBook error: ", error.message);
      }
    },
  },
};
</script>

<style scoped></style>
