<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>
*   @version Release:
*   Date: 2019-06-04
------------------------------------------------->
<template>
    <div>
        <div>
            <el-row>
                <el-col :span="3">
                    <img src="http://127.0.0.1:8085/user/27a4c77cdc18d3c2c2b2230a5cd2470e1556349959.gif" class="image">
                    <el-row>
                        <el-col :span="4">
                            <img src='../assets/man.png' style="height: 10px;width: 10px">
                        </el-col>
                        <el-col :span="12"><p>Kite</p></el-col>
                    </el-row>
                </el-col>
                <el-col :span="1">
                    <p style="margin-top: 20px;color:#cca4e3">回 复:
                    </p>
                </el-col>
                <el-card>
                    <el-col :span="13">
                        <p>准备充分，就完事了！</p>
                    </el-col>
                    <el-col :offset="7" style="text-align: right" :span="4">
                        <span
                                class="el-icon-chat-dot-round text"
                                aria-hidden="true"
                                @click="showDialog(0)"
                        ><span style="vertical-align: text-top;margin-left:10px;">回复</span></span>
                    </el-col>
                    <el-col>
                        <div style="background-color: #e7e7eb">
                            <p>mumu: 如何准备毕业答辩ppt</p>
                        </div>
                    </el-col>
                    <el-col>
                        <p>Kitetop: 跪求大佬指导，小生不胜感激！</p>
                    </el-col>
                </el-card>
            </el-row>
        </div>

        <div>
            <el-row>
                <el-col :span="3">
                    <img src="http://127.0.0.1:8085/user/27a4c77cdc18d3c2c2b2230a5cd2470e1556349959.gif" class="image">
                    <el-row>
                        <el-col :span="4">
                            <img src='../assets/woman.png' style="height: 10px;width: 10px">
                        </el-col>
                        <el-col :span="12"><p>mumu</p></el-col>
                    </el-row>
                </el-col>
                <el-col :span="1">
                    <p style="margin-top: 20px;color:#cca4e3">回 复:
                    </p>
                </el-col>
                <el-card>
                    <el-col :span="13">
                        <p>现在网络资源这么多，只要想学，不必拘泥于书，看看一些视频，这样效率会快很多！</p>
                    </el-col>
                    <el-col :offset="7" style="text-align: right" :span="4">
                        <span
                                class="el-icon-chat-dot-round text"
                                aria-hidden="true"
                                @click="showDialog(0)"
                        ><span style="vertical-align: text-top;margin-left:10px;">回复</span></span>
                    </el-col>
                    <el-col>
                        <div style="background-color: #e7e7eb">
                            <p>Kitetop: 手把手教你设计留言薄系统</p>
                        </div>
                    </el-col>
                    <el-col>
                        <p>Kitetop: 多看看书，多写写代码</p>
                    </el-col>
                </el-card>
            </el-row>
        </div>
        <!--回复消息组件-->
        <div v-if="visit">
            <add-response-dialog
                    :theme-id="themeId"
                    :response-id="responseId"
                    :father-id="fatherId"
                    @show-dialog="showDialog"
            ></add-response-dialog>
        </div>
    </div>
</template>

<script>
    import AddResponseDialog from './user/AddResponseDialog'

    export default {
        name: "Notice",
        data() {
            return {
                visit: false,
                themeId: null,
                responseId: null,
                fatherId: null,
            }
        },
        components: {AddResponseDialog},
        created() {
            this.checkLogin();
        },
        methods: {
            //检测是否登录
            checkLogin() {
                if (this.$cookies.get('userId') == null) {
                    alert("您还没有登录，请登录后在进行操作～");
                    this.$router.push({path: '/user/center'})
                    this.$emit('change-index', 3)
                }
            },
            //显示dialog
            showDialog(responseId) {
                if (this.$cookies.get('userId') == null) {
                    alert('你还没有登录，需要登录后才能发布留言');
                } else {
                    this.responseId = responseId;
                    this.visit = !this.visit;
                }
            },
        },
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
        font-size: 10px;
    }
</style>
