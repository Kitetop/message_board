<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>          *
*   @version Release: v1.0                       *
*   Date: 2019-05-05                             *
------------------------------------------------->
<template>
    <div>
        <div v-if="hasLogin">
            <el-col :span="3">
                <!--用户头像部分-->
                <img v-if="user.active === '正常'" :src="user.image" class="image"/>
                <img v-if="user.active === '封禁'" src="./../../assets/ban.jpg" class="image"/>
                <el-row>
                    <el-col :span="4">
                        <img v-if="user.sex == 1" src='../../assets/man.png' style="height: 10px;width: 10px">
                        <img v-if="user.sex != 1" src="../../assets/woman.png"
                             style="height: 10px;width: 10px">
                    </el-col>
                    <el-col :span="12"><p>{{user.username}}</p></el-col>
                </el-row>
            </el-col>
            <el-col :span="20" :offset="1">
                <el-card class="box-card">
                    <el-row>
                        <el-col :span="2" style="margin-top: 5px;text-align: center;font-size: 10px">
                            <span>账号：</span>
                        </el-col>
                        <div class="text item">
                            <el-col :span="8">
                                <el-input size="mini" style="vertical-align: middle" v-model="user.account" disabled type="text"></el-input>
                            </el-col>
                        </div>
                        <el-col :span="2" style="margin-top: 5px;text-align: center;font-size: 10px">
                            <span>用户名：</span>
                        </el-col>
                        <div class="text item">
                            <el-col :span="8">
                                <el-input size="mini" style="vertical-align: middle" v-model="updateUser.username" type="text"></el-input>
                            </el-col>
                        </div>
                    </el-row>
                </el-card>
            </el-col>
        </div>
        <div v-if="!hasLogin">
            <Login></Login>
        </div>
    </div>

</template>

<script>
    import Login from './../Login'

    export default {
        name: "UserCenter",
        components: {Login},
        data() {
            return {
                hasLogin: false,
                user: {},
                updateUser: {},
            }
        },
        created() {
            this.checkLogin();
        },
        methods: {
            //检测是否登录并且获得用户信息
            checkLogin() {
                if (this.$cookies.get('userId') != null) {
                    this.hasLogin = true;
                    this.userInfo();
                }
            },
            //获得用户信息
            userInfo() {
                let userId = this.$cookies.get('userId');
                this.axios({
                    url: this.HOST.HOST + 'user/info',
                    method: 'get',
                    params: {id: userId}
                }).then(res => {
                    if (res.data.status == 0) {
                        this.user = res.data.data;
                        //深拷贝对象
                        this.updateUser = JSON.parse(JSON.stringify(this.user));
                    } else {
                        this.$cookies.remove('userId');
                        this.hasLogin = false;
                    }
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

    .text {
        font-size: 14px;
    }

    .box-card {
        background-color: #e0f0e9;
    }
</style>
