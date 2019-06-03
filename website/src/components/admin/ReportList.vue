<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>
*   @version Release: v1.0
*   Date: 2019-05-22
------------------------------------------------->
<template>
    <div>
        <el-row>
            <el-col :span="24">
                <!--用户信息记录表-->
                <div style="padding-top: 10px">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="text-danger">
                            <th class="text-center">留言编号</th>
                            <th class="text-center">用户昵称</th>
                            <th class="text-center">用户头像</th>
                            <th class="text-center">留言内容</th>
                            <th class="text-center">举报数</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center" v-for="(response, index) in responses">
                            <td>{{response.id}}</td>
                            <td>{{response.user_name}}</td>
                            <td>
                                <img :src="response.user_image" class="image">
                            </td>
                            <td>
                                <div v-if="response.type == 1">
                                    <img :src="response.context" class="image">
                                </div>
                                <div v-if="response.type == 0">
                                    {{response.context}}
                                </div>
                            </td>
                            <td>{{response.report}}</td>
                            <td>
                                <el-button type="danger" size="mini" @click="deleteUser(index)" plain>删除
                                </el-button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </el-col>
        </el-row>

        <!--分页部分-->
        <div style="text-align: center">
            <Page v-bind:total='total'
                  v-bind:size='size'
                  @change-page='changePage'
            ></Page>
        </div>
    </div>
</template>

<script>
    import Page from '../Page'

    export default {
        name: "ReportList",
        components: {Page},
        data() {
            return {
                responses: {},
                type: 2,
                size: 5,
                total: 0,
            }
        },
        created() {
            this.reportList();
        },
        methods: {
            reportList(page = 1, limit = 5) {
                this.axios({
                    url: this.HOST.HOST + 'report/list',
                    method: 'get',
                    params: {
                        id: this.$cookies.get('userId'),
                        type: this.type,
                        page: page,
                        limit: limit,
                    }
                }).then(res => {
                    if (res.data.status === 0) {
                        let data = res.data.data;
                        this.total = Number(data.total);
                        delete data['total'];
                        delete data['prev'];
                        delete data['next'];
                        this.responses = data;
                    } else {
                        alert(res.data.message);
                    }
                })
            },
            changePage(page) {
                this.reportList(page);
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
</style>
