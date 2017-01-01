<template>
    <div class="container">

        <div class="header">
            <h3>分享社区后台管理</h3>
            <div style="flex: 1"></div>
            <el-dropdown>
      <span class="el-dropdown-link">
        更多<i class="el-icon-caret-bottom el-icon--right"></i>
      </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item>查看资料</el-dropdown-item>
                    <el-dropdown-item>登出</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>

        </div>
        <div class="main">
            <div class="menu">
                <el-menu router default-active="2" class="el-menu-vertical-demo">
                    <el-menu-item v-for="item in menus" :route="item" index="2"><i class="el-icon-menu"></i>{{item.title}}
                    </el-menu-item>
                </el-menu>
            </div>
            <div class="center">
                <transition name="fade" mode="out-in">
                    <router-view></router-view>
                </transition>
            </div>
        </div>

    </div>
</template>
<script>
    //    import Lib from '../assets/js/Lib.js';
    export default {
        data() {
            return {
                menus: [],
            }
        },
        mounted (){
            var _this = this;
            this.$http.get('admin/userMenus').then(function (response) {
//                _this.loading2 = false;
                var data = response.data;
                console.log(data)
                if (data.status) {
                    _this.menus = data.data
                } else {
                    _this.$message.error({
                        message: data.message
                    });
                }
            }).catch(function (err) {
//                _this.loading2 = false;
            });
        },
        methods: {}
    }
</script>

<style scoped lang="sass">
    .container {
        flex: 1;
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .header {
        display: flex;
        background: #303072;
        height: 50px;
        color: #fff;
        text-indent: 1em;
    }

    .main {
        flex: 1;
        display: flex;
    }

    .menu {
        width: 180px;
    }
    .menu .el-menu{
       overflow: auto;
    }

    .center {
        padding: 5px 10px;
        overflow: auto;
        flex: 1;
    }

    .fade-enter-active, .fade-leave-active {
        transition: all .2s ease
    }

    .fade-enter, .fade-leave-active {
        opacity: 0
    }

</style>






