<template>
  <div>
    <index-navbar />
    <section
      class="header relative pt-8 items-center flex flex-col h-screen max-h-[860px]"
    >
      <div
        class="container mx-auto items-center justify-center flex flex-col mt-32"
      >
        <div class="w-full lg:max-w-[70%] px-4">
          <div class="pt-4 sm:pt-0 text-center">
            <h2 class="font-semibold text-3xl text-slate-600 mb-4">
              Pesquise um RMA usando seu código de rastreamento
            </h2>
            <p class="text-lg leading-relaxed text-slate-500">
              Coloque o código do RMA enviado em seu e-mail para acompanhar o
              processo.
            </p>
          </div>
          <div class="mt-10 pt-0 flex flex-wrap" style="gap: 10px">
            <input
              type="text"
              placeholder="Código do RMA *"
              v-model="id"
              v-on:keydown.enter="searchRma"
              class="px-3 py-2 flex-1 mx-32 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline"
            />
          </div>
        </div>
      </div>

      <div
        class="my-24 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row"
      >
        <img
          class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
          src=""
          alt=""
        />
        <div class="flex flex-col justify-between p-4 leading-normal">
          <h5
            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
          >
            {{ searchResults.Nome }}
          </h5>
          <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            Here are the biggest enterprise technology acquisitions of 2021 so
            far, in reverse chronological order.
          </p>
        </div>
      </div>
    </section>
    <Footer />
  </div>
</template>
<script>
import axios from "axios";
import IndexNavbar from "@/components/Navbars/IndexNavbar.vue";
import Footer from "@/components/Footers/Footer.vue";

export default {
  name: "Search",
  data() {
    return {
      id: "",
      searchResults: [],
    };
  },
  components: {
    IndexNavbar,
    Footer,
  },
  methods: {
    async searchRma() {
      axios
        .get("http://rma.fingertech.com.br/backend/search.php", this.search)
        .then(function (response) {
          console.log(response.data);
          this.searchResults = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
