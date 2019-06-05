<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>          *
*   @version Release: v1.0                       *
*   Date: 2019-05-03                             *
------------------------------------------------->
<template>
    <div>
        <el-row>
            <el-col>
                <el-card>
                    <el-col :span="10" :offset="6">
                    <el-form label-position="right" label-width="80px" size="small">

                        <el-form-item label="账户:">
                            <el-input v-model="form.account"></el-input>
                        </el-form-item>
                        <el-form-item label="用户昵称:">
                            <el-input v-model="form.name"></el-input>
                        </el-form-item>
                        <el-form-item label="密码:">
                            <el-input v-model="form.password"></el-input>
                        </el-form-item>
                        <el-form-item label="头像:">
                            <input id="image" type="file"></input>
                        </el-form-item>
                        <el-form-item label="性别:">
                            <el-radio-group v-model="form.sex">
                                <el-radio label="男"></el-radio>
                                <el-radio label="女"></el-radio>
                            </el-radio-group>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" plain size="mini" round @click="onSubmit">立即注册</el-button>
                            <el-button type="warning" plain size="mini" round native-type="reset">取消</el-button>
                        </el-form-item>

                    </el-form>
                    </el-col>
                </el-card>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        name: "register",
        data() {
            return {
                form: {
                    account: null,
                    name: null,
                    password: null,
                    sex: null
                }
            }
        },
        methods: {
            onSubmit() {
                this.axios({

                })
            }
        }
    }
</script>

<style scoped>
    .text {
        font-size: 10px;
        color: #75b0f9;
    }
</style>
