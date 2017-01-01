var dics = {};

var Rxports =  function (Vue) {
    
  return{
        /**
         * 字典表数据定义
         * 如有类似但key或值不同请重新写一条数据，不要破坏原有结构
         */
        dictionary: {
            sex: {1: "男", 2: "女"},
        },
        /**
         * 获取数组字典
         * @param name
         * @returns {Array}
         */
        dictionarys(name){
        if (dics[name]) {
            return dics[name]
        }
        var names = this.dictionary[name],
            newName = [];
        if (names) {
            for (var i in names) {
                newName.push({
                    name: names[i],
                    value: i
                })
            }
        }
        dics[name] = newName;
        return newName
    },
        /**
         * 获取key的方法
         * @param nodes 数组
         * @param keyName key名
         * @param sub  是否有子集，传入
         * @returns {Array}
         */
        getKeys: function (nodes, keyName, sub) {
            var ids = [];
            var _this = this;
            if (nodes && nodes.length > 0) {
                for (var i = 0; i < nodes.length; i++) {
                    ids.push(nodes[i][keyName]);
                    if (!!sub && sub.length > 0) {
                        ids = _this.getKeys(sub, keyName, sub);
                    }
                }
            }
            return ids;
        }
    }
};
module.exports = Rxports



































