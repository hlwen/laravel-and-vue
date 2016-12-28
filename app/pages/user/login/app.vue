<template>
  <div id="app">
    <div class="d">
      登录页
    </div>
    <img v-bind:src="logoImg">
    <h1>{{ msg }}</h1>
    <el-button @click.native="startHacking">Let's do it</el-button>
	 <el-checkbox v-model="checked">备选项</el-checkbox>
	 <el-date-picker
      v-model="value3"
      type="datetimerange"
      placeholder="选择时间范围"
      style="width:350px">
    </el-date-picker>
  </div>
</template>

<script>
import logo from 'assets/img/logo.png'
export default {
  data () {
    return {
      msg: 'Use Vue 2.0 Today!',
      logoImg:logo,
	  checked:true,
	  value3:''
    }
  },

  methods: {
    startHacking () {
      this.$notify({
        title: 'It Works',
        message: 'We have laid the groundwork for you. Now it\'s your time to build something epic!',
        duration: 6000
      })
    }
  }
}
</script>

<style>
body {
  font-family: Helvetica, sans-serif;
}
</style>
