<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>          *
*   @version Release: v1.0                       *
*   Date: 2019-05-04                             *
------------------------------------------------->
<template>
    <div>
        <el-divider></el-divider>
        <div v-if="flag">
            <div v-for="(response, index) in responses">
                <el-row>
                    <el-col :span="2">
                        <img :src="response.user_image" class="image"/>
                        <el-row>
                            <el-col :span="4">
                                <img v-if="response.user_sex == 1" src='../../assets/man.png'
                                     style="height: 10px;width: 10px">
                                <img v-if="response.user_sex != 1" src="../../assets/woman.png"
                                     style="height: 10px;width: 10px">
                            </el-col>
                            <el-col :span="12">
                                <p v-if="response.user_sex == 1" class="man">{{response.user_name}}</p>
                                <p v-if="response.user_sex == 0" class="woman">{{response.user_name}}</p>
                            </el-col>
                        </el-row>
                    </el-col>
                    <el-col :span="2">
                        <p style="margin-top: 20px;color:#cca4e3">回复:<span style="color: #674598"> {{response.accept_name}}</span>
                        </p>
                    </el-col>
                    <el-col :span="20">
                        <el-card class="box-card">
                            <div class="text item">
                                <el-row>
                                    <el-col :span="18">
                                        <p v-if="response.type == 0">{{response.context}}</p>
                                        <img :src="response.context" v-if="response.type == 1"
                                             style="height: 100px;width: 100px">
                                    </el-col>
                                    <el-row>
                                        <el-col :span="2" :offset="2">
                                    <span @click="action(response.id, index, 0)"
                                          class="glyphicon glyphicon glyphicon-thumbs-up"
                                          aria-hidden="true"> {{'：' + response.agree}}</span>
                                        </el-col>
                                        <el-col :span="2">
                                    <span @click="action(response.id, index, 1)"
                                          class="glyphicon glyphicon glyphicon-thumbs-down" aria-hidden="true"> {{'：' + response.report}}</span>
                                        </el-col>
                                        <el-col :span="5" :offset="17">
                                            <p style="color: #88aba6">时间：{{response.time}}</p>
                                        </el-col>
                                        <el-col :span="2">
                                    <span class="el-icon-chat-dot-round"
                                          style="vertical-align: middle"
                                          @click="showDialog(response.id)"
                                    >
                                        <span style="vertical-align: text-top"> 回复</span>
                                    </span>
                                        </el-col>
                                    </el-row>
                                </el-row>
                            </div>
                        </el-card>
                    </el-col>
                </el-row>
            </div>
            <div>
                <el-row>
                    <!--分页组件-->
                    <el-col :span="10" :offset="8">
                        <Page
                                v-bind:total="total"
                                :size="size"
                                @change-page='changePage'>
                        </Page>
                    </el-col>
                    <!--回复父楼-->
                    <el-col :offset="22">
                        <span
                                class="el-icon-chat-dot-round"
                                aria-hidden="true"
                                @click="showDialog(fatherId)"
                        ><span style="vertical-align: text-top"> 回复</span></span>
                    </el-col>
                </el-row>
            </div>
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
        <div v-if="!flag">
            暂无留言
            <!--回复父楼-->
            <el-col :offset="22">
                        <span
                                class="el-icon-chat-dot-round"
                                aria-hidden="true"
                                @click="showDialog(fatherId)"
                        ><span style="vertical-align: text-top"> 回复</span></span>
            </el-col>
        </div>
    </div>
</template>

<script>
    import Page from "./Page";
    import AddResponseDialog from "./AddResponseDialog";

    export default {
        name: "ResponseList",
        components: {AddResponseDialog, Page},
        props: ['themeId', 'fatherId'],
        data() {
            return {
                responses: {},
                flag: true,
                total: 0,
                size: 2,
                visit: false,
                responseId: 0,
            }
        },
        created() {
            this.responseList(this.fatherId);
        },
        methods: {
            //显示dialog
            showDialog(responseId) {
                if(this.$cookies.get('userId') == null) {
                    alert('你还没有登录，需要登录后才能发布留言');
                } else {
                    this.responseId = responseId;
                    this.visit = !this.visit;
                }
            },
            //得到指定页数的数据
            changePage(page) {
                this.responseList(this.fatherId, page);
            },
            /**
             * 用户点赞举报
             */
            action(id, index, type) {
                this.axios({
                    url: this.HOST.HOST + 'response/action',
                    params: {id: id, type: type}
                }).then(res => {
                    if (res.data.status == 0) {
                        if (type == 0) {
                            let agree = Number(this.responses[index].agree) + 1;
                            this.$set(this.responses[index], 'agree', agree);
                        } else {
                            let report = Number(this.responses[index].report) + 1;
                            this.$set(this.responses[index], 'report', report);
                        }
                    }
                    alert(res.data.message);
                }).catch(err => {

                })
            },
            responseList(id, page = 1, limit = 2) {
                this.axios({
                    url: this.HOST.HOST + 'response/clist',
                    params: {
                        id: id,
                        page: page,
                        limit: limit
                    }
                }).then(res => {
                    if (res.data.status == 0) {
                        let data = res.data.data;
                        if (data.total == 0) {
                            this.flag = false;
                        } else {
                            this.total = Number(data.total);
                            delete data['next'];
                            delete data['total'];
                            delete data['prev'];
                            this.responses = data;
                        }
                    } else {
                        alert(res.data.message);
                    }
                }).catch(err => {
                })
            }
        }
    }
</script>

<style scoped>
    .image {
        border-color: aliceblue;
        border-style: solid;
        height: 50px;
        width: 50px;
    }
</style>
