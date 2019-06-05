<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>
*   @version Release: v1.0
*   Date: 2019-06-03
------------------------------------------------->
<template>
    <div>
        <el-row>
            <el-col :span="2" style="margin-top: 5px;text-align: right;font-size: 10px">
                <span>头像：</span>
            </el-col>
            <el-col :offset="1" :span="10">
                <div>
                    <img :src="user.image" class="image">
                </div>
            </el-col>
        </el-row>
        <el-row style="margin-top: 20px">
            <el-col :span="2" style="margin-top: 5px;text-align: right;font-size: 10px">
                <span>昵称：</span>
            </el-col>
            <div class="text item">
                <el-col :span="10" :offset="1">
                    <el-input size="mini" style="vertical-align: middle" v-model="user.username"
                              disabled
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
                        <img src="../assets/admin.png" style="height: 16px;width: 16px">
                    </div>
                    <div v-if="user.status == 2">
                        <span style="font-size: 10px;color: #ff2d51;">会员</span>
                        <img src="../assets/vip.png" style="height: 16px;width: 16px">
                    </div>
                </el-col>
            </div>
        </el-row>

        <el-row style="margin-top: 10px">
            <el-col :span="2" style="margin-top: 2px;text-align: right;font-size: 10px">
                <span>性别：</span>
            </el-col>
            <el-col :offset="1" :span="10">
                <div v-if="user.sex == 1">
                    <span style="font-size: 10px">男</span>
                </div>
                <div v-if="user.sex == 0">
                    <span style="font-size: 10px">女</span>
                </div>
            </el-col>
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
    </div>
</template>

<script>
    export default {
        name: "UserInfo",
        created() {
            this.id = this.$route.query.id;
            this.userInfo(this.id);
        },
        data() {
            return {
                id: null, //需要查询的用户的id
                user: {}, //存储用户信息
            }
        },
        methods: {
            userInfo(id) {
                this.axios({
                    url: this.HOST.HOST + 'user/info',
                    method: 'get',
                    params: {id: id},
                }).then(res => {
                    if (res.data.status === 0) {
                        this.user = res.data.data;
                        this.$emit('user_info', this.user)
                    } else {
                        alert(res.data.message);
                    }
                })
            },
        }
    }
</script>

<style scoped>

</style>
