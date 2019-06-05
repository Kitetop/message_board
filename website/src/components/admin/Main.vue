<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>
*   @version Release: v1.0
*   Date: 2019-06-03
------------------------------------------------->
<template>
    <div>
        <el-container>
            <el-header>
                <el-row>
                    <el-col :span="18" :offset="3">
                        <Head></Head>
                    </el-col>
                </el-row>
            </el-header>
            <el-row>
                <el-container>
                    <el-col :offset="3" :span="6">
                        <el-aside>
                            <el-menu
                                    class="el-menu-vertical-demo"
                                    router
                                    :default-active="active"
                                    active-text-color="#ffa400">
                                <el-menu-item index="/admin/user">
                                    <i class="el-icon-user"></i>
                                    <span slot="title">用户列表</span>
                                </el-menu-item>
                                <el-menu-item index="/admin/report">
                                    <i class="el-icon-menu"></i>
                                    <span slot="title">举报列表</span>
                                </el-menu-item>
                            </el-menu>
                        </el-aside>
                    </el-col>
                    <el-col :span="12">
                        <el-main>
                            <router-view/>
                        </el-main>
                    </el-col>
                </el-container>
            </el-row>
        </el-container>
    </div>
</template>
<script>
    import Head from './Head';

    export default {
        name: 'Main',
        components: {Head},
        data() {
            return {
                status: '', // 用户的身份类型
                active: null,
            }
        },
        created() {
            this.checkLogin();
            this.active = this.getIndex();
            this.status = this.$cookies.get('userType');
        },
        methods: {
            checkLogin() {
                if (this.$cookies.get('userId') === null) {
                    this.$router.push({path: '/login'})
                }
            },
            getIndex() {
                let uri = this.$route.path;
                if(uri === '/') {
                    return null;
                } else {
                    return uri;
                }
            },
        },
    }
</script>
<style scoped>
    .el-header, .el-footer {
        color: #333;
        text-align: center;
        #line-height: 60px;
    }

    .el-aside {
        text-align: center;
        #line-height: 200px;
    }

    .el-main {
        #line-height: 160px;
        padding: 0 0 0 0;
    }

    body > .el-container {
        margin-bottom: 40px;
    }

    .el-container:nth-child(5) .el-aside,
    .el-container:nth-child(6) .el-aside {
        #line-height: 260px;
    }

    .el-container:nth-child(7) .el-aside {
        $ line-height: 320px;
    }
</style>
