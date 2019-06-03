<!------------------------------------------------
*   @author Kitetop <1363215999@qq.com>          *
*   @version Release: v1.0                       *
*   Date: 2019-05-03                             *
------------------------------------------------->
<template>
    <div>
        <div style="margin-bottom: 20px">
            <el-row>
                <el-col :span="2">
                    <el-button @click="setType(1)" size="small" plain autofocus type="primary" round>最新 <i class="el-icon-arrow-right el-icon-position"></i></el-button>
                </el-col>
                <el-col :span="2">
                    <el-button @click="setType(0)" size="small" plain type="danger" round>最热 <i class="glyphicon glyphicon-fire"></i></el-button>
                </el-col>
            </el-row>
        </div>
        <div v-for="(theme,index) in themes">
            <el-card class="box-card">
                <div slot="header" class="clearfix">
                    <span>{{theme.title}}</span>
                </div>
                <div @click="themeInfo(theme.id)">
                    <p class="text item">{{theme.context }}</p>
                    <el-row class="ResAndTime">
                        <el-col :offset="17" :span="2">
                            <p>回复：{{theme.response_num}}</p>
                        </el-col>
                        <el-col :span="5">
                            <p style="color: #88aba6">时间：{{theme.time}}</p>
                        </el-col>
                    </el-row>
                </div>
            </el-card>
        </div>

        <!--分页部分-->
        <div style="text-align: center">
            <el-row>
                <el-col>
                    <Page v-bind:total='total'
                          v-bind:size='size'
                          @change-page = 'changePage'
                    ></Page>
                </el-col>
            </el-row>
        </div>
    </div>
</template>

<script>
    import Page from './Page'

    export default {
        name: "ThemeList",
        components: {Page},
        data() {
            return {
                themes: {},
                type: 1,
                total: 0,
                size: 5,
            }
        },
        created() {
            this.themeList();
        },
        methods: {
            setType(type) {
                this.type = type;
                this.themeList();
            },
            //得到指定页数的数据
            changePage(page) {
                this.themeList(page);
            },
            //跳转到帖子详情页面
            themeInfo(id) {
                this.$emit('change-index');
                this.$router.push({
                    path: '/index/theme_info',
                    query:{id: id,}
                });
            },
            //获得帖子数据
            themeList(page = null,limit = 5) {
                this.axios({
                    url: this.HOST.HOST + '/theme/list',
                    method: 'GET',
                    params: {
                        type: this.type,
                        limit: limit,
                        page: page,
                    }
                }).then(response => {
                    if (response.data.status == 0) {
                        let data = response.data.data;
                        this.next = data.next;
                        this.total = Number(data.total);
                        delete data['next'];
                        delete data['total'];
                        delete data['prev'];
                        this.themes = data;
                    } else {
                        alert(response.data.message)
                    }
                }).catch(error => {

                })
            },
        }
    }
</script>

<style scoped>
    .clearfix {
        font-size: 14px;
        color: #909399;
    }

    .text {
        font-size: 10px;
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
