<template>
<div class="col-sm-2 col-sm-offset-5">
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="test" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
      Dropdown
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
      <li><a href="#">Action</a></li>
      <li><a href="#">Another action</a></li>
      <li><a href="#">Something else here</a></li>
      <li role="separator" class="divider"></li>
      <li><a href="#">Separated link</a></li>
    </ul>
  </div>
</div>
</template>

<script>

export default {
  name: 'HelloWorld',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  },
  created () {
    this.test();
  },
  methods: {
    test() {
      console.log(this.HOST.HOST)
    }
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
