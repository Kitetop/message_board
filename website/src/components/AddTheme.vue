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
                <el-form ref="form" :model="form" label-width="80px">
                    <el-form-item label="标题">
                        <el-input type="textarea" autosize  v-model="form.title"></el-input>
                    </el-form-item>
                    <el-form-item label="内容">
                        <el-input type="textarea" :autosize="{ minRows: 2, maxRows: 8}" v-model="form.content"></el-input>
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
    export default {
        name: "AddTheme",
        data() {
            return {
                form: {
                    name: '',
                    region: '',
                    date1: '',
                    date2: '',
                    delivery: false,
                    type: [],
                    resource: '',
                    desc: ''
                }
            }
        },
        methods: {
            onSubmit() {
                console.log('submit!');
            }
        }
    }
</script>

<style scoped>
</style>
