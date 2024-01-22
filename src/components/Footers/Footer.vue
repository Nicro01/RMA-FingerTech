<template>
  <footer class="relative bg-slate-300 pt-8 pb-6 mt-32">
    <div
      class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20 h-20"
      style="transform: translateZ(0)"
    >
      <svg
        class="absolute bottom-0 overflow-hidden"
        xmlns="http://www.w3.org/2000/svg"
        preserveAspectRatio="none"
        version="1.1"
        viewBox="0 0 2560 100"
        x="0"
        y="0"
      >
        <polygon
          class="text-slate-300 fill-current"
          points="2560 0 2560 110 0 110"
        ></polygon>
      </svg>
    </div>
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap text-center lg:text-left">
        <div class="w-full lg:w-6/12 px-4">
          <h4 class="text-3xl font-semibold text-slate-700">
            Vamos manter contato!
          </h4>
          <h5 class="text-base mt-0 mb-2 text-slate-600">
            Nos envie uma mensagem e entraremos em contato o mais rápido
            possível.
          </h5>
          <div class="mt-6 lg:mb-0 mb-6">
            <button class="flex items-center">
              <i class="fab fa-whatsapp text-slate-500 text-2xl"></i>
              <p class="ml-2">043 9 9999-9999</p>
            </button>
            <button class="flex items-center">
              <i class="fas fa-envelope text-slate-500 text-xl"></i>
              <p class="ml-2">contato@fingertech.com.br</p>
            </button>
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-4">
          <div class="flex flex-wrap items-top mb-6">
            <div class="w-full lg:w-4/12 px-4 ml-auto">
              <span
                class="block uppercase text-slate-500 text-sm font-semibold mb-2"
              >
                Links Úteis
              </span>
              <ul class="list-unstyled">
                <li>
                  <a
                    class="text-slate-600 hover:text-slate-800 font-semibold block pb-2 text-sm"
                    href="http://suporte.fingertech.com.br/"
                    target="_blank"
                  >
                    Suporte
                  </a>
                </li>
                <li>
                  <a
                    class="text-slate-600 hover:text-slate-800 font-semibold block pb-2 text-sm"
                    href="https://fingertech.com.br/"
                    target="_blank"
                  >
                    FingerTech
                  </a>
                </li>
                <li>
                  <a
                    class="text-slate-600 hover:text-slate-800 font-semibold block pb-2 text-sm"
                    href="https://github.com/FingerTechBR"
                    target="_blank"
                  >
                    Github
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-6 border-slate-300" />
      <div
        class="flex flex-wrap items-center md:justify-between justify-center"
      >
        <div class="w-full md:w-4/12 px-4 mx-auto text-center">
          <div class="text-sm text-slate-500 font-medium py-1">
            Copyright © {{ date }} RMA by
            <a
              href="https://fingertech.com.br/"
              class="text-slate-500 hover:text-slate-800"
            >
              FingerTech
            </a>
            .
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
export default {
  data() {
    return {
      date: new Date().getFullYear(),
    };
  },
};
</script>
