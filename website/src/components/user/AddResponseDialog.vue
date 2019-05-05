<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>          *
*   @version Release: v1.0                       *
*   Date: 2019-05-05                             *
------------------------------------------------->
<template>
    <div>
        <el-dialog :visible.sync="show">
            <div>
                <el-row>
                    <el-button @click="setType(0)" size="mini" plain type="primary" autofocus round>文字<i
                            class="el-icon-document"></i>
                    </el-button>
                    <el-button @click="setType(1)" size="mini" plain type="warning" round>图片<i
                            class="el-icon-arrow-right el-icon-picture"></i></el-button>
                </el-row>
                <!--文本内容-->
                <div v-if="type == 0">
                    <el-form>
                        <el-form-item label="内容：">
                            <el-input v-model="text" type="textarea"></el-input>
                        </el-form-item>
                    </el-form>
                </div>
                <div v-if="type == 1" class="image">
                    <input id="image" type="file"></input>
                </div>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="close" size="mini">取 消</el-button>
                <el-button type="primary" size="mini" @click="submit">确 定</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "AddResponseDialog",
        props: ['userId', 'themeId', 'responseId', 'fatherId'],
        data() {
            return {
                fileList: [],
                show: true,
                type: 0,
                text: '',
                image: ''
            }
        },
        methods: {
            submit() {
                this.$emit('show-dialog');
                let data = new FormData();
                data.append('themeId', this.themeId);
                data.append('userId', 1);
                data.append('fatherId', this.fatherId);
                data.append('responseId', this.responseId);
                data.append('type', this.type);
                if (this.type == 0) {
                    //上传文本内容
                    data.append('text', this.text);
                } else {
                    let form = document.getElementById('image');
                    let file = form.files[0];
                    data.append('image', file);
                }
                this.addResponse(data);
            },
            close() {
                this.$emit('show-dialog');
            },
            /**
             * 设置回复消息的类型
             * @param type
             */
            setType(type) {
                this.type = type;
            },
            addResponse(data) {
                this.axios({
                    url: this.HOST.HOST + 'response/add',
                    method: 'post',
                    headers: {'Content-Type': 'multipart/form-data'},
                    data: data
                }).then(res => {
                    alert(res.data.message);
                    this.$router.push('empty');
                    this.$router.go(-1);
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>

<style scoped>
    .image {
        font-size: 10px;
        margin-top: 10px;
    }
</style>
