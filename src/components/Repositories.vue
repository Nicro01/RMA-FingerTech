<script>
import axios from "axios";

export default {
  name: "Repositories",
  data() {
    return {
      repositories: [],
    };
  },
  props: {
    style: {
      type: Object,
      required: true,
    },

    className: {
      type: String,
      required: true,
    },
  },
  mounted() {
    axios.get("https://api.github.com/users/Nicro01/repos").then((response) => {
      this.repositories = response.data;
    });
  },
};
</script>
<template>
  <div>
    <span
      v-for="(repo, index) in repositories"
      :key="index"
      :class="className"
      :style="style"
      ><div class="col-span-1">
        <a :href="repo.html_url" target="_blank">{{ repo.name }}</a>
      </div>
      <div class="col-span-1">
        <p>{{ repo.description ?? "No Description" }}</p>
      </div></span
    >
  </div>
</template>
