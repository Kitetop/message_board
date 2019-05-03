<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>          *
*   @version Release: v1.0                       *
*   Date: 2019-05-03                             *
------------------------------------------------->
<template>
    <div>
        <el-row>
            <el-col :span="16" :offset="4">
                <el-menu
                        :default-active="activeIndex"
                        mode="horizontal"
                        active-text-color="#ffd04b">
                    <el-menu-item index="1">已发布活动</el-menu-item>
                    <el-menu-item index="2">发布活动</el-menu-item>
                    <el-menu-item index="3">邀请审稿</el-menu-item>
                    <el-menu-item index="4">消息中心</el-menu-item>
                </el-menu>
            </el-col>
            <el-col :span="2" :offset="1">
                <div v-if="flag">
                    <el-dropdown>
                        <el-button size="small" type="default">
                            {{this.$cookies.get('name')}}<i class="el-icon-arrow-down el-icon--right"></i>
                        </el-button>
                        <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item>Your Profile</el-dropdown-item>
                            <el-dropdown-item>Settings</el-dropdown-item>
                            <el-dropdown-item @click.native="SignOut">Sign out</el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>
                </div>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="16" :offset="4">
                <router-view/>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        name: "Header",
        data() {
            return {
                flag: false,
                activeIndex: '1',
            }
        },
        methods: {
            checkLogin() {
                if (this.$cookies.get('id') != null) {
                    this.flag = true;
                }
            }
        },
        created() {
            this.checkLogin();
        }
    }
</script>

<style scoped>

</style>
