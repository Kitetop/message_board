<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>          *
*   @version Release: v1.0                       *
*   Date: 2019-05-04                             *
------------------------------------------------->
<template>
    <div>
        <el-row>
            <div>
                <el-col :span="3">
                    <img :src="theme.user_image" class="image"/>
                    <el-row>
                        <el-col :span="4">
                            <img v-if="theme.user_sex == 1" src='../../assets/man.png' style="height: 10px;width: 10px">
                            <img v-if="theme.user_sex != 1" src="../../assets/woman.png"
                                 style="height: 10px;width: 10px">
                        </el-col>
                        <el-col :span="12"><p>{{theme.user_name}}</p></el-col>
                    </el-row>
                </el-col>
                <el-col :span="21">
                    <el-card class="box-card">
                        <div class="text item">
                            {{theme.context}}
                        </div>
                        <!--回复父楼-->
                        <el-col :offset="22" :span="2">
                        <span
                                class="el-icon-chat-dot-round text"
                                aria-hidden="true"
                                @click="showDialog(0)"
                        ><span style="vertical-align: text-top;margin-left:10px;">回复</span></span>
                        </el-col>
                    </el-card>
                </el-col>
            </div>
        </el-row>
        <div v-for="(father, index) in fathers">
            <el-row>
                <el-col :span="3">
                    <img :src="father.user_image" class="image"/>
                    <el-row>
                        <el-col :span="4">
                            <img v-if="father.user_sex == 1" src='../../assets/man.png'
                                 style="height: 10px;width: 10px">
                            <img v-if="father.user_sex != 1" src="../../assets/woman.png"
                                 style="height: 10px;width: 10px">
                        </el-col>
                        <el-col :span="12">
                            <p v-if="father.user_sex == 1">{{father.user_name}}</p>
                            <p v-if="father.user_sex == 0">{{father.user_name}}</p>
                        </el-col>
                    </el-row>
                </el-col>
                <el-col :span="21">
                    <el-card class="box-card">
                        <div class="text item">
                            <el-row>
                                <el-col :span="18">
                                    <p v-if="father.type == 0">{{father.context}}</p>
                                    <img :src="father.context" v-if="father.type == 1"
                                         style="height: 100px;width: 100px">
                                </el-col>
                                <el-row>
                                    <el-col :span="2" :offset="2">
                                    <span @click="action(father.id, index, 0)"
                                          class="glyphicon glyphicon glyphicon-thumbs-up"
                                          aria-hidden="true"> {{'：' + father.agree}}</span>
                                    </el-col>
                                    <el-col :span="2">
                                    <span @click="action(father.id, index, 1)"
                                          class="glyphicon glyphicon glyphicon-thumbs-down" aria-hidden="true"> {{'：' + father.report}}</span>
                                    </el-col>
                                    <el-col :span="4" :offset="18">
                                        <p style="color: #88aba6">时间：{{father.time}}</p>
                                    </el-col>
                                    <el-col :span="2">
                                    <span class="el-icon-message-solid"
                                          @click="changeFlag(index)"
                                          aria-hidden="true"> <span style="vertical-align: text-top"> 留言</span></span>
                                    </el-col>
                                </el-row>
                            </el-row>
                            <el-row v-if="flag[index]">
                                <el-col :span="24">
                                    <response-list :father-id="father.id" :theme-id="id"></response-list>
                                </el-col>
                            </el-row>
                        </div>
                    </el-card>
                </el-col>
            </el-row>
        </div>

        <!--分页部分-->
        <div style="text-align: center">
            <el-row>
                <el-col>
                    <Page v-bind:total='total'
                          v-bind:size=5
                          @change-page = 'changePage'
                    ></Page>
                </el-col>
            </el-row>
        </div>

        <!--回复消息dialog组件-->
        <div v-if="visit">
            <add-response-dialog
                    :theme-id="id"
                    :response-id="responseId"
                    :father-id=0
                    @show-dialog="showDialog"
            ></add-response-dialog>
        </div>
    </div>
</template>

<script>
    import ResponseList from './ResponseList';
    import AddResponseDialog from './AddResponseDialog';
    import Page from './Page';

    export default {
        name: "ThemeInfo",
        components: {ResponseList, AddResponseDialog, Page},
        data() {
            return {
                id: null,
                userId: null,
                theme: {},
                userStyle: null,
                total: null,
                page: null,
                fathers: {},
                response: false,
                flag: [],
                visit: false
            }
        },
        created() {
            this.id = this.$route.query.id;
            this.themeInfo(this.id);
            this.getData();
        },
        methods: {
            //显示dialog
            showDialog(responseId) {
                if (this.$cookies.get('userId') == null) {
                    alert('你还没有登录，需要登录后才能发布留言');
                } else {
                    this.responseId = responseId;
                    this.visit = !this.visit;
                }
            },
            changeFlag(index) {
                if (this.flag[index] == true) {
                    this.flag.splice(0, this.flag.length);
                } else {
                    this.flag.splice(0, this.flag.length);
                    this.flag[index] = true;
                }
            },
            /**
             * 设置性别图标
             */
            sex() {
                if (this.theme.user_sex == 1) {
                    this.userStyle = 'man';
                } else {
                    this.userStyle = 'woman';
                }
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
                            let agree = Number(this.fathers[index].agree) + 1;
                            this.$set(this.fathers[index], 'agree', agree);
                        } else {
                            let report = Number(this.fathers[index].report) + 1;
                            this.$set(this.fathers[index], 'report', report);
                        }
                    }
                    alert(res.data.message);
                }).catch(err => {

                })
            },
            /**
             * 获得初始数据
             */
            getData() {
                this.getFather();
            },
            changePage(page) {
                this.getFather(page);
            },
            /**
             * 得到父系留言
             */
            getFather(page = null) {
                this.axios({
                    url: this.HOST.HOST + '/response/flist',
                    params: {
                        id: this.id,
                        page: page
                    }
                }).then(response => {
                    if (response.data.status == 0) {
                        let data = response.data.data;
                        this.total = Number(data.total);
                        delete data['next'];
                        delete data['total'];
                        delete data['prev'];
                        this.fathers = data;
                    }
                }).catch(error => {

                })
            },
            /**
             * 获得帖子详情
             * @param id
             */
            themeInfo(id) {
                this.axios({
                    url: this.HOST.HOST + '/theme/details',
                    params: {id: id}
                }).then(response => {
                    let data = response.data;
                    if (data.status != 0) {
                        alert(data.message);
                    } else {
                        this.theme = data.data;
                        this.sex();
                    }
                }).catch(error => {

                })
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

    .man {
        text-align: center;
        color: #4B5CC4;
    }

    .woman {
        text-align: center;
        color: #F56C6C;
    }

    .text {
        font-size: 10px;
    }

    .item {
        padding: 18px 0;
    }
</style>
