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
                                <el-submenu index="1">
                                    <template slot="title">
                                        <div style="text-align: left">
                                            <i class="el-icon-s-grid"></i>
                                            <span>公共管理</span>
                                        </div>
                                    </template>
                                    <el-menu-item-group>
                                        <el-menu-item index="1-1">
                                            <div style="font-size: 10px">
                                                <i class="el-icon-edit"></i>
                                                <span>修改信息</span>
                                            </div>
                                        </el-menu-item>
                                        <el-menu-item index="1-2">
                                            <div style="font-size: 10px">
                                                <i class="el-icon-warning-outline"></i>
                                                <span>修改密码</span>
                                            </div>
                                        </el-menu-item>
                                    </el-menu-item-group>
                                </el-submenu>
                                <el-submenu index="2">
                                    <template slot="title">
                                        <div style="text-align: left">
                                            <i class="el-icon-setting"></i>
                                            <span>系统管理</span>
                                        </div>
                                    </template>
                                    <el-menu-item-group>
                                        <el-menu-item index="/user">
                                            <div style="font-size: 10px">
                                                <i class="el-icon-user"></i>
                                                <span>用户信息管理</span>
                                            </div>
                                        </el-menu-item>
                                        <el-menu-item index="/depart">
                                            <div style="font-size: 10px">
                                                <i class="el-icon-s-unfold"></i>
                                                <span>部门信息管理</span>
                                            </div>
                                        </el-menu-item>
                                        <el-menu-item index="/class">
                                            <div style="font-size: 10px">
                                                <i class="el-icon-coin"></i>
                                                <span>种类信息管理</span>
                                            </div>
                                        </el-menu-item>
                                        <el-menu-item index="/equip">
                                            <div style="font-size: 10px">
                                                <i class="el-icon-s-tools"></i>
                                                <span>设备信息管理</span>
                                            </div>
                                        </el-menu-item>
                                    </el-menu-item-group>
                                </el-submenu>
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
            }
        },
        created() {
            this.checkLogin()
            this.status = this.$cookies.get('userType');
        },
        methods: {
            checkLogin() {
                if (this.$cookies.get('userId') === null) {
                    this.$router.push({path: '/login'})
                }
            }
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
