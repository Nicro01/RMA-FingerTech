<template>
  <div>
    <index-navbar />
    <section
      class="header relative pt-16 items-center flex h-screen max-h-[860px]"
    >
      <div class="container mx-auto items-center flex flex-wrap">
        <div class="w-full md:w-8/12 lg:w-6/12 xl:w-6/12 px-4">
          <div class="pt-32 sm:pt-0">
            <h2 class="font-semibold text-4xl text-slate-600">
              RMA - Formulário de Garantia
            </h2>
            <p class="mt-4 text-lg leading-relaxed text-slate-500">
              Estamos aqui para ajudar. Preencha o formulário abaixo para
              iniciar o processo de garantia. Nossa equipe de suporte entrará em
              contato com você o mais rápido possível.
            </p>
            <div class="mt-12 flex justify-center">
              <button
                @click="scrollToNextSection"
                class="flex flex-col items-center justify-center font-extralight float-animation"
              >
                <p>Preencher formulário</p>
                <span class="text-2xl">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="m19.5 8.25-7.5 7.5-7.5-7.5"
                    />
                  </svg>
                </span>
              </button>
            </div>
          </div>
        </div>
      </div>

      <img
        class="absolute top-0 b-auto right-0 pt-16 sm:w-6/12 -mt-48 sm:mt-0 w-10/12 max-h-860-px"
        src="https://i.postimg.cc/XqRkNtsp/pattern-vue.png"
        alt="..."
      />
    </section>

    <section
      class="mt-48 w-6/12 mx-auto md:mt-40 pb-40 bg-slate-100 select-none"
      id="form"
    >
      <div class="flex flex-wrap items-stretch mb-3 mx-auto">
        <select
          v-model="selectedSolicitation"
          class="px-3 py-3 placeholder-white text-white bg-[#264387] rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pr-10"
        >
          <option :value="null" disabled class="text-slate-400">
            Está solicitação é para produto(s) :
          </option>
          <option
            v-for="(solicitation, index) in solicitationOptions"
            :key="index"
            :value="solicitation.value"
          >
            {{ solicitation.label }}
          </option>
        </select>
      </div>
      <div v-show="termsAccept != null">
        <form class="container" @submit.prevent="submitForm">
          <div class="mb-3 pt-0 flex flex-wrap" style="gap: 10px">
            <input
              type="text"
              placeholder="Nome/Empresa *"
              v-model="formInput.Nome"
              class="px-3 py-3 w-5/12 flex-1 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline"
            />
          </div>
          <div class="mb-3 pt-0 flex flex-wrap" style="gap: 10px">
            <input
              type="text"
              v-model="formInput.CNPJ"
              placeholder="CPF ou CNPJ *"
              v-mask="['###.###.###-##', '##.###.###/####-##']"
              class="px-3 py-3 w-1/3 flex-1 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline"
            />
            <input
              type="text"
              v-model="formInput.Responsavel"
              placeholder="Responsável *"
              class="px-3 py-3 w-1/3 flex-1 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline"
            />
            <select
              v-model="formInput.Estado"
              class="px-3 py-3 w-1/3 flex-1 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline"
            >
              <option selected disabled :value="0">
                Selecione um Estado *
              </option>
              <option v-for="(estado, index) in estados" :key="index">
                {{ estado.nome }}
              </option>
            </select>
          </div>
          <div class="mb-3 pt-0 flex flex-wrap" style="gap: 10px">
            <input
              type="text"
              v-model="formInput.Telefone"
              placeholder="Telefone *"
              v-mask="['(##) ####-####', '(##) #####-####']"
              class="px-3 py-3 w-1/3 flex-1 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline"
            />
            <input
              type="text"
              v-model="formInput.Email"
              placeholder="E-mail *"
              class="px-3 py-3 w-1/3 flex-1 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline"
            />
          </div>
          <div class="mb-3 pt-0 flex flex-wrap" style="gap: 10px">
            <select
              v-model="formInput.Produto"
              class="px-3 py-3 w-1/3 flex-1 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline"
            >
              <option selected disabled :value="0">
                Selecione um Produto *
              </option>
              <option v-for="(producto, index) in productos" :key="index">
                {{ producto.name }}
              </option>
            </select>
          </div>
          <div class="mb-3 pt-0 flex flex-wrap" style="gap: 10px">
            <input
              type="text"
              v-model="formInput.Serial"
              placeholder="N° Série *"
              class="px-3 py-3 w-1/3 flex-1 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline"
            />
            <input
              type="text"
              v-model="formInput.Modelo"
              placeholder="Modelo *"
              class="px-3 py-3 w-1/3 flex-1 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline"
            />
          </div>
          <div class="mb-1 pt-0 flex flex-wrap" style="gap: 10px">
            <input
              type="date"
              v-model="formInput.Data"
              placeholder="Data da Compra *"
              class="px-3 py-3 w-1/3 flex-1 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline"
            />
            <input
              type="text"
              v-model="formInput.NotaFiscal"
              placeholder="NF *"
              class="px-3 py-3 w-1/3 flex-1 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline"
            />
          </div>
          <label class="text-sm text-gray-500 dark:text-gray-300" for="date">
            Data da Compra *
          </label>
          <div class="mb-3 my-5 pt-0 flex flex-wrap">
            <input
              class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
              aria-describedby="file_input_help"
              id="file_input"
              type="file"
              @change="validateFile"
            />
            <p
              class="mt-1 text-sm text-gray-500 dark:text-gray-300"
              id="file_input_help"
            >
              * PDF, JPG (Tamanho Máximo 5mb).
            </p>
          </div>
          <div class="mb-3 pt-0 flex flex-wrap" style="gap: 10px">
            <textarea
              placeholder="Descrição do Problema *"
              v-model="formInput.Observacao"
              class="px-3 py-3 w-full flex-1 placeholder-slate-500 text-slate-600 relative bg-white rounded text-sm border border-slate-300 outline-none focus:outline-none focus:shadow-outline resize-none"
            ></textarea>
          </div>

          <div class="flex justify-center mt-10">
            <button
              class="text-white active:bg-emerald-600 font-bold uppercase text-sm px-6 py-2 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
              type="button"
              style="background-color: #264387"
              @click="addProduct"
            >
              Adicionar a Lista<i class="ml-3 fas fa-solid fa-caret-down"></i>
            </button>
          </div>

          <div class="relative overflow-x-auto mt-10">
            <table
              class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
              <thead
                class="text-gray-700 text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
              >
                <tr>
                  <th scope="col" class="px-3 py-3">Produto</th>
                  <th scope="col" class="px-3 py-3">N° Série</th>
                  <th scope="col" class="px-3 py-3">Modelo</th>
                  <th scope="col" class="px-3 py-3">Data da Compra</th>
                  <th scope="col" class="px-3 py-3">N° Nota</th>
                  <th scope="col" class="px-3 py-3">Desc. Defeito</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                  v-show="this.form.length == 0"
                >
                  <td colspan="6">Nenhum produto adicionado!</td>
                </tr>
                <tr v-for="(product, index) in form" :key="index">
                  <td class="px-3 py-3">{{ product.Produto }}</td>
                  <td class="px-3 py-3">{{ product.Serial }}</td>
                  <td class="px-3 py-3">{{ product.Modelo }}</td>
                  <td class="px-3 py-3">{{ product.Data }}</td>
                  <td class="px-3 py-3">{{ product.NotaFiscal }}</td>
                  <td class="px-3 py-3">{{ product.Observacao }}</td>
                </tr>
              </tbody>
            </table>
            <p class="mt-5 text-red-500">
              Será enviado um email para o endereço preenchido no cadastro, com
              todas as informações preenchidas no formulário, e será enviado
              juntamente, o código do RMA de cada produtos para consulta do
              status da sua solicitação.
            </p>
          </div>

          <div class="flex justify-center mt-10">
            <button
              class="text-white flex items-center active:bg-emerald-600 font-bold uppercase text-sm text-center px-12 py-2 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
              style="background-color: #264387"
              type="submit"
            >
              <p>Enviar</p>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="w-4 h-4 ml-3"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"
                />
              </svg>
            </button>
          </div>
        </form>
      </div>
      <div
        class="overflw-y-auto p-5"
        style="max-height: 350px; overflow-y: auto"
        v-show="termsAccept == null && selectedSolicitation == 1"
      >
        <p>
          Solicitação de garantia através do site, leia e aceite os termos
          abaixo:
        </p>
        <p>
          Para solicitar a garantia de um produto, é necessário previamente
          preencher o Formulário de Garantia – RMA.
        </p>
        <p>
          Após o preenchimento, será informado o código de RMA, o qual deve ser
          encaminhado junto com o produto, na parte externa da embalagem, para
          análise técnica.
        </p>
        <p>
          Aguarde o recebimento do e-mail de liberação, para o envio do produto
          à Fingertech. A notificação da liberação será enviada para o endereço
          de e-mail cadastrado neste Formulário.
        </p>
        <p>
          Após o envio do produto, é possível acompanhar o status da análise e
          devolução do produto, através do link
          <a href="http://www.fingertech.com.br/rma"
            >http://www.fingertech.com.br/rma</a
          >
          clicando em “Consulta do Status do Serviço”.
        </p>
        <p>
          Conforme descrito no documento - Política Geral de Garantia, a análise
          dos produtos e serviços de reparo, caso seja necessário, serão
          prestados exclusivamente na sede da Fingertech na cidade de Londrina
          no Paraná.
        </p>

        <h2>Produtos em garantia:</h2>
        <p>
          O envio de produtos será liberado pelo sistema de RMA e aceito nas
          instalações da Fingertech, SOMENTE com a apresentação da cópia da NF
          de compra, e seu devido número de série.
        </p>
        <p>
          Cliente sem Inscrição Estadual, deverá escrever no verso da NF - de
          próprio punho, os detalhes do defeito seguido da assinatura do
          responsável.
        </p>
        <p>
          Cliente com Inscrição Estadual, deverá emitir Nota Fiscal de garantia
          com um dos seguintes CFOP:
        </p>
        <ul>
          <li>CFOP 5949 / 6949 - Remessa em Garantia;</li>
          <li>CFOP 5915 / 6915 - Remessa para Conserto;</li>
        </ul>

        <p>
          O prazo para análise e reparo de peças e/ou equipamentos que forem
          enviados em regime de garantia, é de até 30 dias, contados a partir do
          recebimento do mesmo pelo departamento responsável.
        </p>
        <p>
          A garantia é válida somente para produtos com defeito de fabricação,
          ou seja, produtos com uso indevido por parte do usuário, não se
          enquadram neste processo.
        </p>
        <p>
          A Fingertech controla suas peças e equipamentos por número de série
          e/ou número de lote, portanto, rasuras ou remoção da etiqueta onde
          consta o número de série do produto, ou número de série diferente
          entre produto e nota fiscal, acarretará no cancelamento imediato da
          garantia do mesmo.
        </p>

        <h2>Responsabilidades com os custos de frete do envio do material:</h2>
        <ul>
          <li>
            Até 7 dias da data da NF de compra – Custos de envio e recebimento
            por conta da Fingertech
          </li>
          <li>
            Até 90 dias da data da NF de compra – Custos de devolução por conta
            da Fingertech.
          </li>
          <li>
            Após 90 dias da data da NF de compras - Custos de envio e retorno
            por conta do cliente.
          </li>
        </ul>
        <p>
          Nosso Departamento Técnico e Comercial está à disposição para qualquer
          outra informação que se faça necessária.
        </p>
        <div class="flex items-center mt-5">
          <input
            id="link-checkbox"
            type="checkbox"
            @change="acceptTerms"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
          />
          <label
            for="link-checkbox"
            class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"
            >Li e aceito os
            <span style="color: rgba(99, 102, 241)">termos</span> mencionados
            acima.</label
          >
        </div>
      </div>
      <div
        class="overflw-y-auto p-5"
        style="max-height: 350px; overflow-y: auto"
        v-show="termsAccept == null && selectedSolicitation == 0"
      >
        <p>
          Solicitação de garantia através do site, leia e aceite os termos
          abaixo:
        </p>
        <p>
          Para solicitar a garantia de um produto, é necessário previamente
          preencher o Formulário de Garantia – RMA. Após o preenchimento, será
          informado o código de RMA, o qual deve ser encaminhado junto com o
          produto, na parte externa da embalagem, para análise técnica. Aguarde
          o recebimento do e-mail de liberação, para o envio do produto à
          Fingertech. A notificação da liberação será enviada para o endereço de
          e-mail cadastrado neste Formulário.
        </p>
        <p>
          Após o envio do produto, é possível acompanhar o status da análise e
          devolução do produto, através do link
          <a href="http://www.fingertech.com.br/rma"
            >http://www.fingertech.com.br/rma</a
          >
          clicando em “Consulta do Status do Serviço”.
        </p>
        <p>
          Conforme descrito no documento - Política Geral de Garantia, a análise
          dos produtos e serviços de reparo, caso seja necessário, serão
          prestados exclusivamente na sede da Fingertech na cidade de Londrina
          no Paraná.
        </p>
        <h2>Produtos fora da garantia:</h2>
        <p>
          O envio de produtos será liberado pelo sistema de RMA e aceito nas
          instalações da Fingertech, SOMENTE com a apresentação da cópia da NF
          de compra, e seu devido número de série. Orçamento NÃO aprovado ou
          produtos recebido sem defeitos, será cobrado R$ 50,00 a título de
          “testes e análise de reparos no produto”. Aprovando o orçamento, este
          custo será dado como “cortesia” ao cliente. Todos os custos de frete
          com o envio e retorno do produto, será de total responsabilidade por
          parte do cliente.
        </p>
        <p>
          Cliente sem Inscrição Estadual, deverá escrever no verso da NF - de
          próprio punho, os detalhes do defeito seguido da assinatura do
          responsável. Cliente com Inscrição Estadual, deverá emitir Nota Fiscal
          com o seguinte CFOP:
        </p>
        <ul>
          <li>CFOP 5915 / 6915 - Remessa para Conserto.</li>
        </ul>
        <p>
          O prazo para análise e reparo de peças e/ou equipamentos que forem
          enviados em regime de garantia, é de até 30 dias, contados a partir do
          recebimento do mesmo pelo departamento responsável. Após 90 dias do
          recebimento do produto na sede da Fingertech, equipamentos com o
          orçamento de serviços não autorizados/retirados, serão descartados
          pela Fingertech sem autorização prévia.
        </p>
        <p>
          Nosso Departamento Técnico e Comercial está à disposição para qualquer
          outra informação que se faça necessária.
        </p>
        <div class="flex items-center mt-5">
          <input
            id="link-checkbox"
            type="checkbox"
            @change="acceptTerms"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
          />
          <label
            for="link-checkbox"
            class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"
            >Li e aceito os
            <span style="color: rgba(99, 102, 241)">termos</span> mencionados
            acima.</label
          >
        </div>
      </div>
    </section>
    <footer-component />
  </div>
</template>
<script>
import IndexNavbar from "@/components/Navbars/IndexNavbar.vue";
import FooterComponent from "@/components/Footers/Footer.vue";

import patternVue from "@/assets/img/pattern_vue.png";

import axios from "axios";

export default {
  data() {
    return {
      patternVue,
      termsAccept: null,
      solicitationOptions: [
        { value: 1, label: "Dentro do prazo de garantia" },
        { value: 0, label: "Fora do prazo de garantia" },
      ],
      estados: [],
      productos: [],
      selectedSolicitation: null,
      selectedForm: null,
      formIndex: 0,
      form: [],
      formInput: {
        Nome: "",
        CNPJ: "",
        Responsavel: "",
        Status: 0,
        Estado: 0,
        Telefone: "",
        Email: "",
        Produto: 0,
        Serial: "",
        Modelo: "",
        Data: "",
        NotaFiscal: "",
        Observacao: "",
        file: "",
        Garantia: "",
      },
    };
  },
  components: {
    IndexNavbar,
    FooterComponent,
  },
  watch: {
    selectedSolicitation: function (val) {
      this.selectedSolicitation = val;
      this.formInput.Garantia = val;
      this.termsAccept = null;
    },
  },
  mounted() {
    axios
      .get("https://servicodados.ibge.gov.br/api/v1/localidades/estados")
      .then((response) => {
        this.estados = response.data;
      })
      .catch((error) => {
        console.log(error);
      });

    axios
      .get("http://rma.fingertech.com.br/backend/produtos.php")
      .then((response) => {
        this.productos = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  methods: {
    acceptTerms(event) {
      this.termsAccept = this.selectedSolicitation;
      event.target.checked = false;
    },

    submitForm() {
      axios
        .post("http://rma.fingertech.com.br/backend/index.php", this.form)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    validateFile(event) {
      const file = event.target.files[0];
      const fileSize = file.size / 1024 / 1024;
      const fileType = file.type;

      if (fileSize > 5) {
        alert("O tamanho do arquivo deve ser menor que 5MB");
        event.target.value = "";
        return;
      }

      if (fileType !== "application/pdf" && fileType !== "image/jpeg") {
        alert("O arquivo deve ser um PDF ou JPG");
        event.target.value = "";
        return;
      }

      this.formInput.file = file;
    },
    scrollToNextSection(event) {
      event.preventDefault();
      const nextSection = document.getElementById("form");
      nextSection.scrollIntoView({ behavior: "smooth" });
    },
    resetFormInput() {
      this.formInput = {
        Nome: this.form[0].Nome,
        CNPJ: this.form[0].CNPJ,
        Responsavel: this.form[0].Responsavel,
        Status: this.form[0].Status,
        Estado: this.form[0].Estado,
        Telefone: this.form[0].Telefone,
        Email: this.form[0].Email,
        Produto: 0,
        Serial: "",
        Modelo: "",
        Data: "",
        NotaFiscal: "",
        Observacao: "",
        file: "",
        Garantia: "",
      };
    },
    addProduct() {
      this.form.push({ ...this.formInput });
      this.formIndex++;
      this.resetFormInput();
    },
  },
};
</script>

<style>
@keyframes float {
  0% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-6px);
  }
  100% {
    transform: translateY(0px);
  }
}

.float-animation {
  animation: float 3s ease-in-out infinite;
}

input[type="file"]::file-selector-button {
  width: 100%;
  padding: 0.75rem 0;
  box-shadow: none;
  border: none;
}
</style>
