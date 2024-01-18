<template>
  <nav
    class="top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg bg-white shadow"
  >
    <div
      class="container px-4 mx-auto flex flex-wrap items-center justify-between"
    >
      <div
        class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start"
      >
        <router-link to="/">
          <img
            src="https://i.postimg.cc/htb6w0G9/logo.png"
            alt="FingerTech - Logo"
            class="h-8"
          />
        </router-link>
        <button
          class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
          type="button"
          v-on:click="setNavbarOpen"
        >
          <i class="fas fa-bars"></i>
        </button>
      </div>
      <div
        class="lg:flex flex-grow items-center"
        :class="[navbarOpen ? 'block' : 'hidden']"
        id="example-navbar-warning"
      >
        <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
          <li class="flex items-center">
            <a
              class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
              href="#"
              target="_blank"
            >
              <i class="text-blueGray-400 fab fa-facebook text-lg leading-lg" />
              <span class="lg:hidden inline-block ml-2">Facebook</span>
            </a>
          </li>

          <li class="flex items-center">
            <a
              class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
              href="#"
              target="_blank"
            >
              <i class="text-blueGray-400 fab fa-linkedin text-lg leading-lg" />
              <span class="lg:hidden inline-block ml-2">Linkedin</span>
            </a>
          </li>

          <li class="flex items-center">
            <a
              class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
              href="https://github.com/FingerTechBR"
              target="_blank"
            >
              <i class="text-blueGray-400 fab fa-github text-lg leading-lg" />
              <span class="lg:hidden inline-block ml-2">GitHub</span>
            </a>
          </li>

          <li class="flex items-center">
            <a
              href="http://suporte.fingertech.com.br/"
              class="text-white active:bg-emerald-600 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
              type="button"
              style="background-color: #264387"
              target="_blank"
            >
              Para Desenvolvedores
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import logo from "@/assets/img/logo.png";

export default {
  data() {
    return {
      navbarOpen: false,
      logo,
    };
  },

  methods: {
    setNavbarOpen: function () {
      this.navbarOpen = !this.navbarOpen;
    },
  },
};
</script>
