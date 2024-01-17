<template>
  <div class="m-4 select-none">
    <div v-for="(cmd, index) in commands" :key="index" class="flex flex-col">
      <div class="flex">
        <div class="flex">
          <p class="text-green-400">
            <span
              class="font-medium"
              style="text-shadow: rgba(255, 255, 255, 0.113) 0px 0px 2px"
              >{{ user }}@</span
            ><span class="text-white">:</span
            ><span class="text-blue-600">~</span
            ><span class="text-white">$</span>
          </p>
          <input
            ref="input"
            type="text"
            class="text-white ms-3 bg-transparent border-none outline-none caret-underscore"
            v-model="commands[index]"
            @keyup.enter="processCommand"
            :disabled="index !== commands.length - 1"
            :style="{
              flexGrow: 1,
              caretColor: 'transparent',
            }"
          />
          <pre
            class="caret-underscore absolute"
            v-show="commands.length == index + 1"
            :style="{
              marginLeft: commands[index].length * 0.6 + 6.2 + 'rem',
            }"
          ><span>&nbsp;</span></pre>
        </div>
      </div>

      <div v-show="outputs[index] == 'help'">
        <Help
          className="font-bold grid grid-cols-2 gap-2 text-indigo-400 my-4"
          style="text-shadow: rgba(255, 255, 255, 0.113) 0px 0px 2px"
        />
      </div>
      <div v-if="outputs[index] == 'projects'">
        <Repositories
          className="font-bold grid grid-cols-2 gap-2 text-indigo-400 my-4"
          style="text-shadow: rgba(255, 255, 255, 0.113) 0px 0px 2px"
        />
      </div>
      <div v-if="outputs[index] == 'welcome'">
        <Welcome />
      </div>
      <p
        v-show="
          commands[index] != 'help' &&
          commands[index] != 'projects' &&
          commands[index] != 'welcome'
        "
        class="text-white my-4"
      >
        {{ outputs[index] }}
      </p>
    </div>
  </div>
</template>

<script>
import Help from "./components/Help.vue";
import Projects from "./components/Projects.vue";
import Welcome from "./components/Welcome.vue";
import Repositories from "./components/Repositories.vue";

export default {
  data() {
    return {
      commands: [""],
      outputs: [""],
      user: "Nicro01",
    };
  },
  components: {
    Help,
    Projects,
    Welcome,
    Repositories,
  },
  mounted() {
    this.$refs.input[0].focus();
  },
  methods: {
    processCommand() {
      const index = this.commands.length - 1;
      switch (this.commands[index]) {
        case "hello":
          this.outputs[index] = `Hello, ${this.user}!`;
          break;
        case "welcome":
          this.outputs[index] = "welcome";
          break;
        case "help":
          this.outputs[index] = "help";
          break;
        case "clear":
        case "cls":
          this.commands = [];
          this.outputs = [];
          break;
        case "user":
          this.outputs[index] = this.user;
          break;
        case "projects":
          this.outputs[index] = "projects";
          break;
        default:
          this.outputs[index] = "Unknown command: " + this.commands[index];
      }
      this.commands.push("");
      this.outputs.push("");
      this.$nextTick(() => {
        this.$refs.input[this.$refs.input.length - 1].focus();
      });
    },
  },
};
</script>

<style scoped>
pre.caret-underscore > span {
  animation: blink 1s step-end infinite;
  width: 1.5px;
  height: 4px;
  background-color: #fff;
}

@keyframes blink {
  from,
  to {
    background-color: transparent;
  }
  50% {
    background-color: #fff;
  }
}
</style>
