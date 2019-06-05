<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>
*   @version Release: v1.0
*   Date: 2019-05-22
*   创建帖子
------------------------------------------------->
<template>
    <div>
        <el-row>
            <el-col>
                <el-form label-width="80px">
                    <el-form-item label="标题">
                        <el-input type="textarea" autosize  v-model="form.title"></el-input>
                    </el-form-item>
                    <el-form-item label="内容">
                        <el-input type="textarea" :autosize="{ minRows: 2, maxRows: 8}" v-model="form.context"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" plain size="mini" @click="onSubmit">立即创建</el-button>
                        <el-button type="danger" plain size="mini" native-type="reset">取消</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import qs from 'qs'

    export default {
        name: "AddTheme",
        data() {
            return {
                form: {
                    title: null,
                    context: null,
                    id: null,
                }
            }
        },
        created() {
            this.checkLogin();
        },
        methods: {
            onSubmit() {
                this.form.id = this.$cookies.get('userId');
                this.axios({
                    url: this.HOST.HOST + 'theme/add',
                    method: 'post',
                    data: qs.stringify(this.form)
                }).then(res => {
                    alert(res.data.message);
                    this.$router.push({path: '/index'})
                })
            },
            //检测是否登录
            checkLogin() {
                if (this.$cookies.get('userId') == null) {
                    alert("您还没有登录，请登录后在进行操作～");
                    this.$router.push({path: '/user/center'});
                    this.$emit('change-index', 3)
                }
            },
        }
    }
</script>

<style scoped>
</style>
