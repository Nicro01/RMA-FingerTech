<template>
  <div class="carousel mx-auto relative">
    <transition-group
      tag="div"
      class="slides grid grid-cols-3 my-10 gap-12"
      name="slide"
      @after-enter="afterTransition"
    >
      <div
        class="slide col-span-1"
        v-for="(repo, index) in currentRepos"
        :key="repo.id"
      >
        <div
          class="rounded-lg max-w-52 bg-slate-200 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]"
        >
          <div class="p-6">
            <h5
              class="mb-2 text-base font-semibold leading-tight text-neutral-800"
            >
              {{ repo.name }}
            </h5>
            <p class="mb-4 text-sm text-neutral-600">
              {{ repo.description ?? "No description" }}
            </p>
            <a
              :href="repo.html_url"
              target="_blank"
              type="button"
              class="inline-block rounded bg-green-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-green-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-green-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]"
              data-te-ripple-init
              data-te-ripple-color="light"
            >
              See More
            </a>
          </div>
        </div>
      </div>
    </transition-group>
    <button @click="prevSlide" class="absolute top-[50%] -ms-20 text-white">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M15.75 19.5 8.25 12l7.5-7.5"
        />
      </svg>
    </button>
    <button
      @click="nextSlide"
      class="absolute top-[50%] right-0 -mr-20 text-white"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="m8.25 4.5 7.5 7.5-7.5 7.5"
        />
      </svg>
    </button>
    <!-- <div class="pagination">
      <button
        v-for="(page, index) in pagination"
        :key="index"
        @click="goToPage(index)"
      >
        {{ page }}
      </button>
    </div> -->
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Projects",
  data() {
    return {
      currentSlide: 0,
      slides: [],
    };
  },
  computed: {
    pagination() {
      return Array.from(
        { length: Math.ceil(this.slides.length / 3) },
        (_, i) => i + 1
      );
    },
    currentRepos() {
      return this.slides.slice(
        this.currentSlide * 3,
        this.currentSlide * 3 + 3
      );
    },
  },
  methods: {
    nextSlide() {
      this.currentSlide = (this.currentSlide + 1) % this.pagination.length;
    },
    prevSlide() {
      this.currentSlide =
        (this.currentSlide + this.pagination.length - 1) %
        this.pagination.length;
    },
    afterTransition() {
      // Handle any cleanup or post-transition logic here
    },
    goToPage(index) {
      this.currentSlide = index;
    },
  },
  mounted() {
    axios.get("https://api.github.com/users/Nicro01/repos").then((response) => {
      this.slides = response.data;
    });
  },
};
</script>

<style>
/* Add your styles here */
</style>
