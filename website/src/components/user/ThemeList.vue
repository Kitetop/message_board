<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>          *
*   @version Release: v1.0                       *
*   Date: 2019-05-03                             *
------------------------------------------------->
<template>
    <div>
        <div v-for="(theme,index) in themes">
            <el-card class="box-card">
                <div slot="header" class="clearfix">
                    <span>{{theme.title}}</span>
                </div>
                <div @click="themeInfo(theme.id, theme.user_id)">
                    <p class="text item">{{theme.context }}</p>
                    <el-row class="ResAndTime">
                        <el-col :offset="17" :span="2">
                            <p>回复：{{theme.response_num}}</p>
                        </el-col>
                        <el-col :span="5">
                            <p>时间：{{theme.time}}</p>
                        </el-col>
                    </el-row>
                </div>
            </el-card>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ThemeList",
        data() {
            return {
                themes: {},
                type: 0,
                total: 0,
                next: null,
                prev: null,
            }
        },
        created() {
            this.themeList();
        },
        methods: {
            themeInfo(id, userId) {
                console.log('id: ' + id + ' userId: ' + userId)
            },
            themeList(url = null) {
                if (url == null) {
                    this.axios({
                        url: this.HOST.HOST + '/theme/list',
                        method: 'GET',
                        params: {
                            type: this.type,
                        }
                    }).then(response => {
                        if (response.data.status == 0) {
                            let data = response.data.data;
                            this.next = data.next;
                            this.total = data.total;
                            this.prev = data.prev;
                            delete data['next'];
                            delete data['total'];
                            delete data['prev'];
                            this.themes = data;
                        } else {
                            alert(response.data.message)
                        }
                    }).catch(function (error) {
                    })
                } else {
                    this.axios.get(url).then(function (response) {
                        if (response.data.status == 0) {
                            this.themes = response.data;
                        } else {
                            alert(response.message)
                        }
                    }).catch(function (error) {

                    })
                }
            }
        }
    }
</script>

<style scoped>
    .clearfix {
        font-size: 18px;
        color: #909399;
    }

    .text {
        font-size: 14px;
        color: #75b0f9;
    }
    .ResAndTime {
        font-size: 10px;
        color: #F56C6C;
    }

    .item {
        margin-bottom: 18px;
    }
</style>
