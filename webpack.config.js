const webpack = require('webpack');
const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const extractStyles = new ExtractTextPlugin('programs-style.bundle.css');

module.exports = {
  context: path.resolve(__dirname),
  entry: {
    app: './js/programs.js'
  },

  module: {
    loaders: [
      { 
        test: /\.js$/, 
        loader: 'babel-loader?presets=es2015', 
        exclude: /node_modules/ 
      },
      {
        test: /\.css$/,
        use: ExtractTextPlugin.extract({
          use: [
            {
              loader: 'css-loader',
              options: { importLoaders: 1 },
            },
            'postcss-loader',
          ],
        }),
      },      
      { 
        test: /\.(png|jpg)$/, 
        loader: 'url?limit=10000', 
        exclude: /node_modules/, 
      }
    ]
  },

  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'programs.bundle.js',
  },
  resolve: {
    modules: [path.resolve(__dirname), 'node_modules'],
  },
  plugins: [
    extractStyles
  ],
}