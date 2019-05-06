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

            <!--用户信息部分-->
            <el-col :span="20" :offset="1">
                <el-card class="box-card">
                    <!--修改头像，注销登录-->
                    <el-row>
                        <el-col :span="2" style="margin-top:5px;text-align: right;font-size: 10px">
                            <span>账号：</span>
                        </el-col>
                        <div class="text item">
                            <el-col :span="8" :offset="1">
                                <span style="font-size: 10px;color: #65a7f8;margin-top: 5px">{{user.account}}</span>
                            </el-col>
                        </div>
                        <el-col :offset="9" :span="4">
                            <el-link type="primary" style="font-size: 10px">修改头像<i
                                    class="el-icon-upload el-icon--right"></i></el-link>
                            <el-link @click="loginOut" type="danger" style="font-size: 10px">注销<i
                                    class="el-icon-s-tools el-icon--right"></i></el-link>
                        </el-col>
                    </el-row>

                    <el-row style="margin-top: 20px">
                        <el-col :span="2" style="margin-top: 5px;text-align: right;font-size: 10px">
                            <span>昵称：</span>
                        </el-col>
                        <div class="text item">
                            <el-col :span="8" :offset="1">
                                <el-input size="mini" style="vertical-align: middle" v-model="updateUser.username"
                                          type="text"></el-input>
                            </el-col>
                        </div>
                    </el-row>

                    <el-row style="margin-top: 10px">
                        <el-col :span="2" style="margin-top: 5px;text-align: right;font-size: 10px">
                            <span>身份：</span>
                        </el-col>
                        <div class="text item">
                            <el-col :span="8" :offset="1" style="margin-top: 1px">
                                <div v-if="user.status == 1">
                                    <span style="font-size: 10px;color: #fa8c35;">管理员</span>
                                    <img src="../../assets/admin.png" style="height: 16px;width: 16px">
                                </div>
                                <div v-if="user.status == 2">
                                    <span style="font-size: 10px;color: #ff2d51;">会员</span>
                                    <img src="../../assets/vip.png" style="height: 16px;width: 16px">
                                </div>
                            </el-col>
                        </div>
                    </el-row>

                    <el-row style="margin-top: 10px">
                        <el-col :span="2" style="margin-top: 5px;text-align: right;font-size: 10px">
                            <span>状态：</span>
                        </el-col>
                        <div class="text item">
                            <el-col :span="8" :offset="1" style="margin-top: 1px">
                                <div v-if="user.active === '封禁'">
                                    <span style="font-size: 10px;color: #ff2d51;">封禁</span>
                                </div>
                                <div v-if="user.active === '正常'">
                                    <span style="font-size: 10px;color: #67C23A;">正常</span>
                                </div>
                            </el-col>
                        </div>
                    </el-row>

                    <el-row style="margin-top: 10px">
                        <el-col :span="2" style="margin-top: 2px;text-align: right;font-size: 10px">
                            <span>性别：</span>
                        </el-col>
                        <el-col :offset="1" :span="10">
                            <div class="text item">
                                <el-radio v-model="updateUser.sex" label="1">男</el-radio>
                                <el-radio v-model="updateUser.sex" label="0">女</el-radio>
                            </div>
                        </el-col>
                    </el-row>

                    <!--更新用户信息按钮组-->
                    <div v-if="update" style="margin-top: 15px">
                        <el-row>
                            <el-col :span="4" :offset="2">
                                <el-button size="mini" type="warning" @click="reset" plain style="width: 100%" round>
                                    取消
                                </el-button>
                            </el-col>
                            <el-col :span="4" :offset="1">
                                <el-button size="mini" type="primary" @click="submit" plain style="width: 100%" round>
                                    修改
                                </el-button>
                            </el-col>
                        </el-row>
                        <el-row>

                        </el-row>
                    </div>
                </el-card>

                <!--管理员的功能操纵组-->
                <div v-if="user.status == 1">

                </div>

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
                update: false,
            }
        },
        /**
         * 判断用户信息是否更新
         */
        watch: {
            updateUser: {
                handler(val, oldVal) {
                    if (JSON.stringify(val) !== JSON.stringify(this.user)) {
                        this.update = true;
                    } else {
                        this.update = false;
                    }
                },
                deep: true
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
            //重制输入信息
            reset() {
                this.updateUser = JSON.parse(JSON.stringify(this.user));
                this.update = false;
            },
            //修改用户信息
            submit() {

            },
            //注销
            loginOut() {
                this.$cookies.remove('userId');
                this.$cookies.remove('userStatus');
                this.$cookies.remove('userName');
                this.$router.push({path: '/'})
            }
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
