<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>
*   @version Release: v1.0
*   Date: 2019-06-03
------------------------------------------------->
<template>
    <div>
        <nav class="navbar" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">留言薄管理系统</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <div>
                        <li><span style="font-size: 5px">欢迎您,{{username}} </span>
                            <el-link @click="loginOut" style="font-size: 5px;margin-left: 5px" type="primary"><i class="el-icon-switch-button"><span> 退出</span></i></el-link>
                        </li>
                    </div>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        name: "Head",
        created() {
          this.username = this.$cookies.get('userName');
        },
        data() {
            return {
                username: null,
            }
        },
        methods: {
            loginOut() {
                this.$router.push({path: '/index'})
            }
        }
    }
</script>

<style scoped>

</style>
