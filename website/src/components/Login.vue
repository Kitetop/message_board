<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>          *
*   @version Release: v1.0                       *
*   Date: 2019-05-03                             *
------------------------------------------------->
<template>
    <div>
        <el-row>
            <el-col :offset="3" :span="18">
                <el-card style="width: 100%; text-align: center;margin-top: 100px">
                    <h2 class="form-signin">Please sign in</h2>
                    <form class="form-signin" role="form">
                        <div class="input-group">
                            <span class="input-group-addon">用户名：</span>
                            <input type="text" class="form-control" placeholder="username" v-model="account">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:</span>
                            <input type="password" class="form-control" placeholder="password" v-model="password">

                        </div>
                        <br>
                        <div style="text-align: center">
                            <el-button type="primary" size="mini" plain @click="login">登录</el-button>
                            <el-button size="mini" plain native-type="reset" type="warning">取消</el-button>
                        </div>
                    </form>
                </el-card>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import qs from 'qs';

    export default {
        name: "Login",
        data() {
            return {
                account: '',
                password: '',
            }
        },
        methods: {
            login() {
                let data =  {
                    account: this.account,
                    password: this.password
                };
                this.axios({
                    url: this.HOST.HOST + 'login',
                    method: 'post',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: qs.stringify(data)
                }).then(res => {
                    alert(res.data.message);
                    if(res.data.status == 0) {
                        let data = res.data.data;
                        this.$cookies.set('userId', data.id, '1d');
                        this.$cookies.set('userName', data.username, '1d');
                        this.$cookies.set('userStatus', data.status, '1d');
                        this.$router.push('/user/center');
                    }
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>

<style scoped>

</style>
