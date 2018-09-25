<template>
  <div class="Main">
    <h1>{{ msg }}</h1>
  </div>
</template>

<script>
export default {
  name: 'Main',
  data () {
    return {
      msg: 'Welcome in main!'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
$primary-color: #111;
h1 {
  font-weight: normal;
  color: $primary-color;
}
</style>
