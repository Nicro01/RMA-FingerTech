<script>
export default {
  name: "Help",
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
};
</script>
<template>
  <div :class="className" :style="style">
    <div class="col-span-1">
      <p>welcome</p>
      <p>hello</p>
      <p>help</p>
      <p>clear | cls</p>
      <p>user</p>
      <p>projects</p>
      <p>about-me</p>
    </div>
    <div class="col-span-1">
      <p>Greets the user</p>
      <p>Lists available commands</p>
      <p>Clears the screen</p>
      <p>Displays the current user</p>
      <p>Displays my projects</p>
      <p>Displays information about me</p>
    </div>
  </div>
</template>
