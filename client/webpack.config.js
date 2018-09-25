const path = require('path');

module.exports = {
    entry: './app/view/js/src/index.js',
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, './app/view/js/dist')
    },
    module: {
        rules: [{
            test: /\.scss$/,
            use: [{
                loader: "style-loader"
            }, {
                loader: "css-loader",
                options: {
                    sourceMap: true
                }
            }, {
                loader: "sass-loader",
                options: {
                    sourceMap: true
                }
            }]
        }]
    }
};