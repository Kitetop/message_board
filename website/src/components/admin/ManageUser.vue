<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>
*   @version Release: v1.0
*   Date: 2019-05-22
*   系统管理员对用户尽心管理
------------------------------------------------->
<template>
    <div>
        <el-card class="box-card">
           <UserInfo @user_info = "setUser"></UserInfo>
            <el-row style="margin-top: 50px" v-if="status == 1">
                <el-col :offset="3" :span="10">
                    <!--对用户进行封禁或者解封按钮-->
                    <div v-if="user.active === '封禁'">
                        <el-button plain round  size="medium" type="success" @click="active(user.id, 0)" style="width: 100%">解封
                        </el-button>
                    </div>
                    <div v-if="user.active === '正常'">
                        <el-button plain round size="medium" type="danger" @click="active(user.id, 1)" style="width: 100%">封禁</el-button>
                    </div>

                </el-col>
            </el-row>
        </el-card>
    </div>
</template>

<script>
    import UserInfo from '../UserInfo'
    export default {
        name: "ManageUser",
        components: {UserInfo},
        created() {
            this.status = this.$cookies.get('userStatus');
        },
        data() {
            return {
                user: {},
                status: null,
            }
        },
        methods: {
            setUser(User) {
                this.user = User;
            },
            active(userId, type) {
                let id = this.$cookies.get('userId');
                this.axios({
                    url: this.HOST.HOST + 'admin/active',
                    method: 'get',
                    params: {
                        id: id,
                        type: type,
                        userId: userId,
                    }
                }).then(res => {
                    alert(res.data.message);
                    this.$router.push('empty');
                    this.$router.go(-1);
                })
            },
        }
    }
</script>

<style scoped>
    .image {
        border-color: aliceblue;
        border-style: solid;
        height: 100px;
        width: 100px;
    }
</style>
