/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-05-03
 */
let HOST = 'http://127.0.0.1:8090/';

//根据实际环境来动态的设置HOTS地址
// if (process.env.NODE_ENV === 'production') {
//     HOST = 'http://10.0.20.190/vote/v1';
// } else if (process.env.NODE_ENV === 'test') {
//     HOST = 'http://192.168.30.101:7003/v1/';
// } else {
//     HOST = 'http://staging-umai-umai-api.duxze.cn/v1/';
// }
export default {
    HOST
}

